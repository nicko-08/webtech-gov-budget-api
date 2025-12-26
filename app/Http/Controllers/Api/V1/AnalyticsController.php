<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnalyticsResource;
use App\Models\FiscalYear;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * @group Analytics
 * Analytics endpoints for dashboard data
 */
class AnalyticsController extends Controller
{
    use ApiResponse;

    /**
     * Get overall summary analytics (all barangays combined)
     */
    public function overallSummary(): JsonResponse
    {
        $summary = Cache::remember('analytics:overall-summary', now()->addMinutes(15), function () {
            $activeFiscalYear = FiscalYear::where('is_active', true)->first();
            if (!$activeFiscalYear) return null;

            // Get ALL barangay summaries and aggregate them
            $summaries = DB::table('budget_summaries')
                ->where('fiscal_year_id', $activeFiscalYear->id)
                ->get();

            if ($summaries->isEmpty()) return null;

            // Aggregate all barangay data
            $totalAllocated = $summaries->sum('total_allocated');
            $totalSpent = $summaries->sum('total_spent');
            $utilizationRate = $totalAllocated > 0 ? ($totalSpent / $totalAllocated) * 100 : 0;

            // Combine spending by category from all barangays
            $combinedSpending = [];
            foreach ($summaries as $summary) {
                $categorySpending = json_decode($summary->spending_by_category, true);

                // Skip if json_decode failed or returned null
                if (!is_array($categorySpending)) {
                    continue;
                }

                // Handle the array format: [{"name": "Infrastructure", "total_spent": "500000"}]
                foreach ($categorySpending as $categoryData) {
                    if (isset($categoryData['name']) && isset($categoryData['total_spent'])) {
                        $categoryName = $categoryData['name'];
                        $amount = (float) $categoryData['total_spent'];
                        $combinedSpending[$categoryName] = ($combinedSpending[$categoryName] ?? 0) + $amount;
                    }
                }
            }


            return (object) [
                'total_allocated' => $totalAllocated,
                'total_spent' => $totalSpent,
                'utilization_rate' => round($utilizationRate, 2),
                'spending_by_category' => json_encode($combinedSpending)
            ];
        });

        if (!$summary) {
            return $this->error('No active fiscal year or summary data available.', 404);
        }

        return $this->resourceResponse(new AnalyticsResource($summary), 'Overall summary retrieved successfully');
    }


    /**
     * Get barangay list for selection cards
     */
    public function barangayList(): JsonResponse
    {
        $barangays = Cache::remember('analytics:barangay-list', now()->addMinutes(10), function () {
            $activeFiscalYear = FiscalYear::where('is_active', true)->first();
            if (!$activeFiscalYear) return collect();

            return DB::table('budgets')
                ->join('government_units', 'budgets.government_unit_id', '=', 'government_units.id')
                ->leftJoin('budget_summaries', function ($join) use ($activeFiscalYear) {
                    $join->on('budgets.government_unit_id', '=', 'budget_summaries.government_unit_id')
                        ->where('budget_summaries.fiscal_year_id', $activeFiscalYear->id);
                })
                ->where('budgets.fiscal_year_id', $activeFiscalYear->id)
                ->select(
                    'budgets.id as budget_id',
                    'budgets.name as budget_name',
                    'government_units.name as barangay_name',
                    'budget_summaries.total_allocated',
                    'budget_summaries.total_spent',
                    'budget_summaries.utilization_rate'
                )
                ->get()
                ->map(function ($item) {
                    $status = $item->utilization_rate > 100 ? 'Over Budget' : ($item->utilization_rate > 80 ? 'Near Limit' : 'Under Budget');

                    return [
                        'budget_id' => $item->budget_id,
                        'barangay_name' => $item->barangay_name,
                        'budget_name' => $item->budget_name,
                        'total_allocated' => (float) $item->total_allocated,
                        'total_spent' => (float) $item->total_spent,
                        'utilization_rate' => (float) $item->utilization_rate,
                        'status' => $status
                    ];
                });
        });

        return $this->success($barangays, 'Barangay list retrieved successfully');
    }

    /**
     * Get detailed analytics for specific barangay
     */
    public function barangayAnalytics(int $budgetId): JsonResponse
    {
        $analytics = Cache::remember("analytics:barangay:{$budgetId}", now()->addMinutes(10), function () use ($budgetId) {
            // Get barangay budget info
            $barangayInfo = DB::table('budgets')
                ->join('government_units', 'budgets.government_unit_id', '=', 'government_units.id')
                ->leftJoin('budget_summaries', function ($join) {
                    $join->on('budgets.government_unit_id', '=', 'budget_summaries.government_unit_id')
                        ->on('budgets.fiscal_year_id', '=', 'budget_summaries.fiscal_year_id');
                })
                ->where('budgets.id', $budgetId)
                ->select(
                    'budgets.name as budget_name',
                    'government_units.name as barangay_name',
                    'budget_summaries.total_allocated',
                    'budget_summaries.total_spent',
                    'budget_summaries.utilization_rate'
                )
                ->first();

            if (!$barangayInfo) return null;

            // Get all projects in this barangay
            $projects = DB::table('budget_items')
                ->leftJoin('expenses', 'budget_items.id', '=', 'expenses.budget_item_id')
                ->where('budget_items.budget_id', $budgetId)
                ->select(
                    'budget_items.id as project_id',
                    'budget_items.name as project_name',
                    'budget_items.allocated_amount',
                    DB::raw('COALESCE(SUM(expenses.amount), 0) as spent_amount')
                )
                ->groupBy('budget_items.id', 'budget_items.name', 'budget_items.allocated_amount')
                ->get()
                ->map(function ($project) {
                    $utilization = $project->allocated_amount > 0 ?
                        ($project->spent_amount / $project->allocated_amount) * 100 : 0;

                    return [
                        'project_id' => $project->project_id,
                        'project_name' => $project->project_name,
                        'allocated_amount' => (float) $project->allocated_amount,
                        'spent_amount' => (float) $project->spent_amount,
                        'utilization_rate' => round($utilization, 2),
                        'status' => $utilization > 100 ? 'Over Budget' : ($utilization > 80 ? 'Near Limit' : 'Under Budget')
                    ];
                });

            return [
                'barangay_info' => $barangayInfo,
                'projects' => $projects
            ];
        });

        if (!$analytics) {
            return $this->error('Barangay not found.', 404);
        }

        return $this->success($analytics, 'Barangay analytics retrieved successfully');
    }
}

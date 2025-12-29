<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class BudgetAnalyticsCalculator
{
    public function recalculate(int $governmentUnitId, int $fiscalYearId): void
    {
        $totalAllocated = DB::table('budgets')
            ->join('budget_items', 'budgets.id', '=', 'budget_items.budget_id')
            ->where('budgets.government_unit_id', $governmentUnitId)
            ->where('budgets.fiscal_year_id', $fiscalYearId)
            ->sum('budget_items.allocated_amount');

        $totalSpent = DB::table('budgets')
            ->join('budget_items', 'budgets.id', '=', 'budget_items.budget_id')
            ->join('expenses', 'budget_items.id', '=', 'expenses.budget_item_id')
            ->where('budgets.government_unit_id', $governmentUnitId)
            ->where('budgets.fiscal_year_id', $fiscalYearId)
            ->sum('expenses.amount');

        $spendingByCategory = DB::table('expenses')
            ->join('budget_items', 'expenses.budget_item_id', '=', 'budget_items.id')
            ->join('budget_categories', 'budget_items.budget_category_id', '=', 'budget_categories.id')
            ->join('budgets', 'budget_items.budget_id', '=', 'budgets.id')
            ->where('budgets.government_unit_id', $governmentUnitId)
            ->where('budgets.fiscal_year_id', $fiscalYearId)
            ->select('budget_categories.name', DB::raw('SUM(expenses.amount) as total_spent'))
            ->groupBy('budget_categories.name')
            ->get();

        $utilization = $totalAllocated > 0
            ? round(($totalSpent / $totalAllocated) * 100, 2)
            : 0;

        DB::table('budget_summaries')->updateOrInsert(
            [
                'government_unit_id' => $governmentUnitId,
                'fiscal_year_id' => $fiscalYearId,
            ],
            [
                'total_allocated' => $totalAllocated,
                'total_spent' => $totalSpent,
                'utilization_rate' => $utilization,
                'spending_by_category' => json_encode($spendingByCategory),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Log::info('Budget analytics recalculated', [
            'government_unit_id' => $governmentUnitId,
            'fiscal_year_id' => $fiscalYearId,
            'total_allocated' => (float) $totalAllocated,
            'total_spent' => (float) $totalSpent,
            'utilization_rate' => $utilization,
        ]);
    }
}

<?php

namespace App\Console\Commands;

use App\Models\FiscalYear;
use App\Models\GovernmentUnit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculateBudgetSummaries extends Command
{
    protected $signature = 'app:calculate-budget-summaries';
    protected $description = 'Calculate and store aggregated budget analytics in the summary table.';

    public function handle()
    {
        $this->info('Starting budget summary calculation...');
        Log::info('Budget summary calculation job started.');

        $activeFiscalYear = FiscalYear::where('is_active', true)->first();
        if (!$activeFiscalYear) {
            $this->warn('No active fiscal year found. Aborting.');
            Log::warning('Budget summary job: No active fiscal year found.');
            return 1;
        }

        $governmentUnits = GovernmentUnit::all();

        foreach ($governmentUnits as $unit) {
            $this->line("Processing unit: {$unit->name}");

            // Calculate total allocated amount
            $totalAllocated = DB::table('budgets')
                ->join('budget_items', 'budgets.id', '=', 'budget_items.budget_id')
                ->where('budgets.government_unit_id', $unit->id)
                ->where('budgets.fiscal_year_id', $activeFiscalYear->id)
                ->sum('budget_items.allocated_amount');

            // Calculate total spent amount
            $totalSpent = DB::table('budgets')
                ->join('budget_items', 'budgets.id', '=', 'budget_items.budget_id')
                ->join('expenses', 'budget_items.id', '=', 'expenses.budget_item_id')
                ->where('budgets.government_unit_id', $unit->id)
                ->where('budgets.fiscal_year_id', $activeFiscalYear->id)
                ->sum('expenses.amount');

            // *** NEW: Calculate spending by category ***
            $spendingByCategory = DB::table('expenses')
                ->join('budget_items', 'expenses.budget_item_id', '=', 'budget_items.id')
                ->join('budget_categories', 'budget_items.budget_category_id', '=', 'budget_categories.id')
                ->join('budgets', 'budget_items.budget_id', '=', 'budgets.id')
                ->where('budgets.government_unit_id', $unit->id)
                ->where('budgets.fiscal_year_id', $activeFiscalYear->id)
                ->select('budget_categories.name', DB::raw('SUM(expenses.amount) as total_spent'))
                ->groupBy('budget_categories.name')
                ->get();

            $utilization = ($totalAllocated > 0) ? ($totalSpent / $totalAllocated) * 100 : 0;

            // Update or create the summary record
            DB::table('budget_summaries')->updateOrInsert(
                ['government_unit_id' => $unit->id, 'fiscal_year_id' => $activeFiscalYear->id],
                [
                    'total_allocated' => $totalAllocated,
                    'total_spent' => $totalSpent,
                    'utilization_rate' => round($utilization, 2),
                    'spending_by_category' => json_encode($spendingByCategory), // <-- ADD THIS LINE
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $this->info('Budget summary calculation completed successfully.');
        Log::info('Budget summary calculation job finished.');
        return 0;
    }
}

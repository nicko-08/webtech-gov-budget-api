<?php

namespace App\Console\Commands;

use App\Models\FiscalYear;
use App\Models\GovernmentUnit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Services\BudgetAnalyticsCalculator;

class CalculateBudgetSummaries extends Command
{
    protected $signature = 'app:calculate-budget-summaries';

    protected $description = 'Calculate and store aggregated budget analytics in the summary table.';

    public function handle(BudgetAnalyticsCalculator $calculator)
    {
        $fiscalYearId = FiscalYear::where('is_active', true)->value('id');
        if (! $fiscalYearId) {
            return 1;
        }

        GovernmentUnit::select('id')
            ->chunkById(50, function ($units) use ($calculator, $fiscalYearId) {
                foreach ($units as $unit) {
                    $calculator->recalculate($unit->id, $fiscalYearId);
                }
            });

        Cache::forget('analytics:overall-summary');
        Cache::forget('analytics:barangay-list');

        return 0;
    }
}

<?php

namespace App\Jobs;

use App\Services\BudgetAnalyticsCalculator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\Dispatchable;

final class RecalculateBudgetAnalytics implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $uniqueFor = 30; // debounce: 30 seconds

    public function __construct(
        public int $governmentUnitId,
        public int $fiscalYearId
    ) {}

    public function uniqueId(): string
    {
        return "analytics:{$this->governmentUnitId}:{$this->fiscalYearId}";
    }

    public function handle(BudgetAnalyticsCalculator $calculator): void
    {
        $calculator->recalculate(
            $this->governmentUnitId,
            $this->fiscalYearId
        );

        Cache::forget("analytics:barangay:{$this->governmentUnitId}");
        Cache::forget('analytics:barangay-list');
        Cache::forget('analytics:overall-summary');
    }
}

<?php

namespace App\Providers;

use App\Events\BudgetModified;
use App\Events\BudgetItemModified;
use App\Events\ExpenseModified;
use App\Events\GovernmentUnitModified;
use App\Events\FiscalYearModified;
use App\Listeners\LogModelModification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        BudgetModified::class => [
            LogModelModification::class,
        ],
        BudgetItemModified::class => [
            LogModelModification::class,
        ],
        ExpenseModified::class => [
            LogModelModification::class,
        ],
        GovernmentUnitModified::class => [
            LogModelModification::class,
        ],
        FiscalYearModified::class => [
            LogModelModification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}

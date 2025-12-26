<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnalyticsController;
use App\Http\Controllers\Api\V1\BudgetController;
use App\Http\Controllers\Api\V1\BudgetItemController;
use App\Http\Controllers\Api\V1\ExpenseController;
use App\Http\Controllers\Api\V1\GovernmentUnitController;
use App\Http\Controllers\Api\V1\FiscalYearController;
use App\Http\Controllers\Api\V1\BudgetCategoryController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;

Route::prefix('v1')->group(function () {
    // Public endpoints with higher rate limit for analytics
    Route::middleware('throttle:120,1')->group(function () {
        Route::get('/analytics/overall-summary', [AnalyticsController::class, 'overallSummary']);
        Route::get('/analytics/barangay-list', [AnalyticsController::class, 'barangayList']);
        Route::get('/analytics/barangay/{budgetId}', [AnalyticsController::class, 'barangayAnalytics']);
    });


    // Auth endpoints with moderate rate limiting
    Route::middleware('throttle:10,1')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name('api.v1.register');
        Route::post('/login', [AuthController::class, 'login'])->name('api.v1.login');
    });

    // Public read-only endpoints
    Route::apiResource('/budgets', BudgetController::class)->only(['index', 'show'])->names('api.v1.public.budgets');
    Route::apiResource('/budget-items', BudgetItemController::class)->only(['index', 'show'])->names('api.v1.public.budget-items');
    Route::get('/budget-items/{budgetItem}/summary', [BudgetItemController::class, 'summary'])->name('api.v1.public.budget-items.summary');
    Route::apiResource('/expenses', ExpenseController::class)->only(['index', 'show'])->names('api.v1.public.expenses');

    // Protected endpoints
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('/budgets', BudgetController::class)
            ->except(['index', 'show'])
            ->middleware('role:admin')
            ->names('api.v1.protected.budgets');

        Route::apiResource('/budget-items', BudgetItemController::class)
            ->except(['index', 'show'])
            ->middleware('role:admin,budget-officer')
            ->names('api.v1.protected.budget-items');

        Route::apiResource('/expenses', ExpenseController::class)
            ->except(['index', 'show'])
            ->middleware('role:admin,budget-officer')
            ->names('api.v1.protected.expenses');

        Route::post('/logout', [AuthController::class, 'logout'])->name('api.v1.logout');

        // Admin-only endpoints
        Route::middleware('role:admin')->group(function () {
            Route::apiResource('/users', UserController::class);
            Route::apiResource('/government-units', GovernmentUnitController::class);
            Route::apiResource('/fiscal-years', FiscalYearController::class);
            Route::apiResource('/budget-categories', BudgetCategoryController::class);
        });
    });
});

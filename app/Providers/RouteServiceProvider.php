<?php

namespace App\Providers;

use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Route::has('login')) {
            return;
        }

        Route::middleware('web')->group(function (): void {
            Route::get('/', [DashboardController::class, 'home'])->name('home');
            Route::get('/budgets', [DashboardController::class, 'budgets'])->name('budgets.index');
            Route::get('/expenses', [DashboardController::class, 'expenses'])->name('expenses.index');
            Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics.dashboard');
            Route::get('/fiscal-years', [DashboardController::class, 'fiscalYears'])->name('fiscal-years.index');

            Route::prefix('auth')->group(function (): void {
                Route::get('/login', [DashboardController::class, 'login'])->name('login');
                Route::post('/login', [DashboardController::class, 'loginSubmit'])->name('login.submit');
                Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
                Route::post('/logout', [DashboardController::class, 'logoutSubmit'])->name('logout.submit');
            });

            Route::prefix('admin')->group(function (): void {
                Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
                Route::get('/users', [DashboardController::class, 'admin'])->name('admin.users.index');
            });
        });
    }
}

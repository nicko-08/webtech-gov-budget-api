<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetItem;
use App\Models\Expense;
use App\Models\FiscalYear;
use App\Models\GovernmentUnit;
use App\Models\User;
use App\Services\AnalyticsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(
        private readonly AnalyticsService $analyticsService
    ) {}

    public function home(): View
    {
        return view('home');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function logout(): View
    {
        return view('auth.logout');
    }

    public function loginSubmit(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->attempt($credentials)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Invalid credentials.',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logoutSubmit(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard(): View
    {
        $activeFiscalYear = $this->activeFiscalYear();
        $activeFiscalYearId = $activeFiscalYear?->id;

        $totalBudget = (float) Budget::query()
            ->when($activeFiscalYearId, fn($query) => $query->where('fiscal_year_id', $activeFiscalYearId))
            ->sum('total_amount');

        $totalSpent = (float) Expense::query()
            ->when($activeFiscalYearId, function ($query) use ($activeFiscalYearId) {
                $query->whereHas('budgetItem.budget', fn($budgetQuery) => $budgetQuery->where('fiscal_year_id', $activeFiscalYearId));
            })
            ->sum('amount');

        $remaining = max(0, $totalBudget - $totalSpent);
        $utilizationRate = $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 1) : 0;

        $categorySpending = BudgetCategory::query()
            ->leftJoin('budget_items', 'budget_categories.id', '=', 'budget_items.budget_category_id')
            ->leftJoin('budgets', function ($join) use ($activeFiscalYearId) {
                $join->on('budget_items.budget_id', '=', 'budgets.id');
                if ($activeFiscalYearId) {
                    $join->where('budgets.fiscal_year_id', $activeFiscalYearId);
                }
            })
            ->leftJoin('expenses', 'budget_items.id', '=', 'expenses.budget_item_id')
            ->groupBy('budget_categories.id', 'budget_categories.name')
            ->select('budget_categories.name', DB::raw('COALESCE(SUM(expenses.amount), 0) as spent'))
            ->orderByDesc('spent')
            ->get();

        $recentExpenses = Expense::query()
            ->with(['budgetItem.budget.governmentUnit'])
            ->when($activeFiscalYearId, function ($query) use ($activeFiscalYearId) {
                $query->whereHas('budgetItem.budget', fn($budgetQuery) => $budgetQuery->where('fiscal_year_id', $activeFiscalYearId));
            })
            ->orderByDesc('transaction_date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'activeFiscalYear',
            'totalBudget',
            'totalSpent',
            'remaining',
            'utilizationRate',
            'categorySpending',
            'recentExpenses',
        ));
    }

    public function fiscalYears(): View
    {
        $allocationByFiscalYear = Budget::query()
            ->groupBy('fiscal_year_id')
            ->select('fiscal_year_id', DB::raw('SUM(total_amount) as total_allocation'))
            ->pluck('total_allocation', 'fiscal_year_id');

        $spentByFiscalYear = DB::table('expenses')
            ->join('budget_items', 'expenses.budget_item_id', '=', 'budget_items.id')
            ->join('budgets', 'budget_items.budget_id', '=', 'budgets.id')
            ->groupBy('budgets.fiscal_year_id')
            ->select('budgets.fiscal_year_id', DB::raw('SUM(expenses.amount) as total_spent'))
            ->pluck('total_spent', 'fiscal_year_id');

        $today = Carbon::today();
        $fiscalYears = FiscalYear::query()
            ->orderByDesc('year')
            ->get()
            ->map(function (FiscalYear $fiscalYear) use ($allocationByFiscalYear, $spentByFiscalYear, $today) {
                $allocation = (float) ($allocationByFiscalYear[$fiscalYear->id] ?? 0);
                $spent = (float) ($spentByFiscalYear[$fiscalYear->id] ?? 0);
                $utilization = $allocation > 0 ? round(($spent / $allocation) * 100, 1) : 0;

                if ($fiscalYear->is_active) {
                    $status = 'Active';
                } elseif ($fiscalYear->start_date && $fiscalYear->start_date->isAfter($today)) {
                    $status = 'Upcoming';
                } else {
                    $status = 'Closed';
                }

                return (object) [
                    'id' => $fiscalYear->id,
                    'year' => $fiscalYear->year,
                    'start_date' => $fiscalYear->start_date,
                    'end_date' => $fiscalYear->end_date,
                    'status' => $status,
                    'total_allocation' => $allocation,
                    'total_spent' => $spent,
                    'utilization_rate' => min(100, $utilization),
                ];
            });

        return view('fiscal-years.index', compact('fiscalYears'));
    }

    public function budgets(): View
    {
        $activeFiscalYear = $this->activeFiscalYear();
        $activeFiscalYearId = $activeFiscalYear?->id;

        $budgetItems = BudgetItem::query()
            ->with(['category', 'budget.governmentUnit'])
            ->withSum('expenses', 'amount')
            ->when($activeFiscalYearId, function ($query) use ($activeFiscalYearId) {
                $query->whereHas('budget', fn($budgetQuery) => $budgetQuery->where('fiscal_year_id', $activeFiscalYearId));
            })
            ->orderByDesc('allocated_amount')
            ->take(20)
            ->get()
            ->map(function (BudgetItem $item) {
                $spent = (float) ($item->expenses_sum_amount ?? 0);
                $allocated = (float) $item->allocated_amount;

                return (object) [
                    'id' => $item->id,
                    'budget_name' => $item->budget?->name ?? $item->name,
                    'category_name' => $item->category?->name ?? 'Uncategorized',
                    'allocated_amount' => $allocated,
                    'spent_amount' => $spent,
                    'utilization_rate' => $allocated > 0 ? min(100, round(($spent / $allocated) * 100)) : 0,
                ];
            });

        return view('budgets.index', compact('budgetItems', 'activeFiscalYear'));
    }

    public function expenses(): View
    {
        $activeFiscalYear = $this->activeFiscalYear();
        $activeFiscalYearId = $activeFiscalYear?->id;

        $expenses = Expense::query()
            ->with(['budgetItem.category', 'budgetItem.budget.governmentUnit'])
            ->when($activeFiscalYearId, function ($query) use ($activeFiscalYearId) {
                $query->whereHas('budgetItem.budget', fn($budgetQuery) => $budgetQuery->where('fiscal_year_id', $activeFiscalYearId));
            })
            ->orderByDesc('transaction_date')
            ->take(20)
            ->get();

        $logsByExpense = AuditLog::query()
            ->with('user')
            ->where('auditable_type', Expense::class)
            ->whereIn('auditable_id', $expenses->pluck('id'))
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('auditable_id');

        $expenseRows = $expenses->map(function (Expense $expense) use ($logsByExpense) {
            $allocated = (float) ($expense->budgetItem?->allocated_amount ?? 0);
            $latestLog = $logsByExpense->get($expense->id)?->first();
            $recordedBy = $latestLog?->user?->name ?? 'System';

            $status = 'Approved';
            if ($allocated > 0 && (float) $expense->amount > $allocated) {
                $status = 'Flagged';
            } elseif ($expense->transaction_date?->isAfter(now()->subDays(3))) {
                $status = 'Pending';
            }

            return (object) [
                'id' => $expense->id,
                'date' => $expense->transaction_date,
                'description' => $expense->description,
                'category' => $expense->budgetItem?->category?->name ?? 'Uncategorized',
                'budget_source' => $expense->budgetItem?->budget?->name ?? 'Unknown Budget',
                'recorded_by' => $recordedBy,
                'status' => $status,
                'amount' => (float) $expense->amount,
            ];
        });

        return view('expenses.index', compact('expenseRows'));
    }

    public function analytics(): View
    {
        $activeFiscalYear = $this->activeFiscalYear();
        $activeFiscalYearId = $activeFiscalYear?->id;

        $summary = $this->analyticsService->overallSummary();
        $distribution = collect($summary?->spending_by_category ?? []);

        $monthlyRows = DB::table('expenses')
            ->join('budget_items', 'expenses.budget_item_id', '=', 'budget_items.id')
            ->join('budgets', 'budget_items.budget_id', '=', 'budgets.id')
            ->when($activeFiscalYearId, fn($query) => $query->where('budgets.fiscal_year_id', $activeFiscalYearId))
            ->selectRaw('MONTH(expenses.transaction_date) as month_num, SUM(expenses.amount) as total_spent')
            ->groupBy('month_num')
            ->orderBy('month_num')
            ->get()
            ->keyBy('month_num');

        $trend = collect(range(1, 12))->map(function (int $month) use ($monthlyRows) {
            return (object) [
                'label' => Carbon::create()->month($month)->format('M'),
                'value' => (float) ($monthlyRows->get($month)->total_spent ?? 0),
            ];
        });

        return view('analytics.dashboard', [
            'trend' => $trend,
            'distribution' => $distribution,
        ]);
    }

    public function admin(): View
    {
        $users = User::query()
            ->orderBy('name')
            ->take(20)
            ->get();

        $defaultUnit = GovernmentUnit::query()
            ->where('type', 'barangay')
            ->value('name') ?? 'System';

        $userRows = $users->map(function (User $user) use ($defaultUnit) {
            $unit = str_contains(strtolower($user->role), 'admin') ? 'System' : $defaultUnit;

            return (object) [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => ucwords(str_replace('-', ' ', $user->role)),
                'unit' => $unit,
                'status' => 'active',
            ];
        });

        return view('admin.users.index', [
            'userCount' => User::count(),
            'governmentUnitCount' => GovernmentUnit::count(),
            'auditLogCount' => AuditLog::count(),
            'userRows' => $userRows,
        ]);
    }

    private function activeFiscalYear(): ?FiscalYear
    {
        return FiscalYear::query()
            ->where('is_active', true)
            ->first()
            ?? FiscalYear::query()->orderByDesc('year')->first();
    }
}

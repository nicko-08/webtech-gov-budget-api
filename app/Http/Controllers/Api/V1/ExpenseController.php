<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ExpenseModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Jobs\RecalculateBudgetAnalytics;

/**
 * @group Expenses
 * Expense management endpoints
 */
class ExpenseController extends Controller
{
    /**
     * List expenses
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $expenses = Expense::query()
            ->with('budgetItem')
            ->when(
                $request->filled('budget_item_id') && $request->integer('budget_item_id'),
                fn($query) => $query->where('budget_item_id', $request->budget_item_id)
            )
            ->latest()
            ->paginate(20);

        return ExpenseResource::collection($expenses);
    }

    /**
     * Create expense
     *
     * @authenticated
     *
     * @bodyParam description string required Expense description. Example: Office supplies purchase
     * @bodyParam amount number required Expense amount. Example: 1500.00
     * @bodyParam budget_item_id integer required Budget item ID. Example: 1
     * @bodyParam transaction_date date required Transaction date. Example: 2024-01-15
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $this->authorize('create', Expense::class);

        $expense = Expense::create($request->validated());

        event(new ExpenseModified(
            $expense,
            $request->user(),
            'created'
        ));

        return (new ExpenseResource(
            $expense->load('budgetItem')
        ))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show expense
     */
    public function show(Expense $expense): ExpenseResource
    {
        return new ExpenseResource(
            $expense->load('budgetItem')
        );
    }

    /**
     * Update expense
     *
     * @authenticated
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): ExpenseResource
    {
        $this->authorize('update', $expense);

        $expense->update($request->validated());

        event(new ExpenseModified(
            $expense,
            $request->user(),
            'updated'
        ));

        return new ExpenseResource(
            $expense->fresh()->load('budgetItem')
        );
    }

    /**
     * Delete expense
     *
     * @authenticated
     */
    public function destroy(Request $request, Expense $expense): Response
    {
        $this->authorize('delete', $expense);

        DB::transaction(function () use ($expense, $request) {
            $governmentUnitId = $expense->budget->government_unit_id;
            $fiscalYearId = $expense->budget->fiscal_year_id;

            $expense->delete();

            event(new ExpenseModified(
                $expense,
                $request->user(),
                'deleted'
            ));

            RecalculateBudgetAnalytics::dispatch(
                $governmentUnitId,
                $fiscalYearId
            );
        });

        return response()->noContent();
    }
}

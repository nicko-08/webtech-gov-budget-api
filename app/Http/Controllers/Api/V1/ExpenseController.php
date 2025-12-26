<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ExpenseModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Expenses
 * Expense management endpoints
 */
class ExpenseController extends Controller
{
    use ApiResponse;

    /**
     * List expenses
     * 
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Expense::with('budgetItem');

        if ($request->filled('budget_item_id') && is_numeric($request->budget_item_id)) {
            $query->where('budget_item_id', (int) $request->budget_item_id);
        }

        $expenses = $query->latest()->paginate(20);
        return ExpenseResource::collection($expenses);
    }

    /**
     * Create expense
     * 
     * @authenticated
     * @bodyParam description string required Expense description. Example: Office supplies purchase
     * @bodyParam amount number required Expense amount. Example: 1500.00
     * @bodyParam budget_item_id integer required Budget item ID. Example: 1
     * @bodyParam transaction_date date required Transaction date. Example: 2024-01-15
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = Expense::create($request->validated());

        event(new ExpenseModified($expense, $request->user(), 'created'));

        return $this->resourceResponse(new ExpenseResource($expense->load('budgetItem')), 'Expense created successfully', 201);
    }

    /**
     * Show expense
     */
    public function show(Expense $expense): ExpenseResource
    {
        return new ExpenseResource($expense->load('budgetItem'));
    }


    /**
     * Update expense
     * 
     * @authenticated
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): JsonResponse
    {
        $expense->update($request->validated());

        event(new ExpenseModified($expense, $request->user(), 'updated'));

        return $this->resourceResponse(new ExpenseResource($expense->fresh()->load('budgetItem')), 'Expense updated successfully');
    }

    /**
     * Delete expense
     * 
     * @authenticated
     */
    public function destroy(Request $request, Expense $expense): JsonResponse
    {
        event(new ExpenseModified($expense, $request->user(), 'deleted'));
        $expense->delete();

        return $this->success(null, 'Expense deleted successfully', 200);
    }
}

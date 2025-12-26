<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\BudgetItemModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBudgetItemRequest;
use App\Http\Requests\UpdateBudgetItemRequest;
use App\Http\Resources\BudgetItemResource;
use App\Models\BudgetItem;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Budget Items
 * Budget item management endpoints
 */
class BudgetItemController extends Controller
{
    use ApiResponse;

    /**
     * List budget items
     * 
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = BudgetItem::with(['budget', 'category']);

        if ($request->filled('budget_id') && is_numeric($request->budget_id)) {
            $query->where('budget_id', $request->budget_id);
        }

        $budgetItems = $query->latest()->paginate(20);
        return BudgetItemResource::collection($budgetItems);
    }

    /**
     * Create budget item
     * 
     * @authenticated
     */
    public function store(StoreBudgetItemRequest $request): JsonResponse
    {
        $budgetItem = BudgetItem::create($request->validated());
        event(new BudgetItemModified($budgetItem, $request->user(), 'created'));

        $budgetItem->load(['budget', 'category']);

        return $this->resourceResponse(new BudgetItemResource($budgetItem), 'Budget item created successfully', 201);
    }

    /**
     * Show budget item
     */
    public function show(BudgetItem $budgetItem): BudgetItemResource
    {
        $budgetItem->load(['budget', 'category'])->loadSum('expenses', 'amount');
        return new BudgetItemResource($budgetItem);
    }

    /**
     * Update budget item
     * 
     * @authenticated
     */
    public function update(UpdateBudgetItemRequest $request, BudgetItem $budgetItem): JsonResponse
    {
        $budgetItem->update($request->validated());
        event(new BudgetItemModified($budgetItem, $request->user(), 'updated'));

        return $this->resourceResponse(new BudgetItemResource($budgetItem->fresh(['budget', 'category'])), 'Budget item updated successfully');
    }

    /**
     * Delete budget item
     * 
     * @authenticated
     */
    public function destroy(Request $request, BudgetItem $budgetItem): JsonResponse
    {
        event(new BudgetItemModified($budgetItem, $request->user(), 'deleted'));
        $budgetItem->delete();

        return $this->success(null, 'Budget item deleted successfully', 200);
    }

    /**
     * Get budget item summary
     */
    public function summary(BudgetItem $budgetItem): JsonResponse
    {
        $budgetItem->load('budget:id,name')->loadSum('expenses', 'amount');

        $spentAmount = $budgetItem->expenses_sum_amount ?? 0;
        $allocatedAmount = $budgetItem->allocated_amount;
        $utilization = ($allocatedAmount > 0) ? ($spentAmount / $allocatedAmount) * 100 : 0;

        $summaryData = [
            'name' => $budgetItem->name,
            'code' => $budgetItem->code,
            'allocated_amount' => $allocatedAmount,
            'spent_amount' => $spentAmount,
            'utilization_percentage' => round($utilization, 2),
            'budget' => [
                'name' => $budgetItem->budget->name,
            ]
        ];

        return $this->success($summaryData, 'Budget item summary retrieved successfully');
    }
}

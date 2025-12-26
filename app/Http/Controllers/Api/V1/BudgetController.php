<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\BudgetModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Budgets
 * Budget management endpoints
 */
class BudgetController extends Controller
{
    use ApiResponse;

    /**
     * List budgets
     * 
     * @queryParam page integer Page number. Example: 1
     */
    public function index(): AnonymousResourceCollection
    {
        $budgets = Budget::with(['governmentUnit', 'fiscalYear'])
            ->select('id', 'name', 'total_amount', 'government_unit_id', 'fiscal_year_id')
            ->latest()
            ->paginate(15);

        return BudgetResource::collection($budgets);
    }

    /**
     * Create budget
     * 
     * @authenticated
     * @bodyParam name string required Budget name. Example: Annual Budget 2024
     * @bodyParam government_unit_id integer required Government unit ID. Example: 1
     * @bodyParam fiscal_year_id integer required Fiscal year ID. Example: 1
     * @bodyParam total_amount number required Total amount. Example: 1000000.00
     */
    public function store(StoreBudgetRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $budget = Budget::create($validated);

        event(new BudgetModified($budget, $request->user(), 'created'));
        $budget->load(['governmentUnit', 'fiscalYear']);

        return $this->resourceResponse(new BudgetResource($budget), 'Budget created successfully', 201);
    }

    /**
     * Show budget
     */
    public function show(Budget $budget): BudgetResource
    {
        $budget->load([
            'governmentUnit',
            'fiscalYear',
            'budgetItems' => function ($query) {
                $query->withSum('expenses', 'amount')
                    ->with('category');
            }
        ]);

        return new BudgetResource($budget);
    }

    /**
     * Update budget
     * 
     * @authenticated
     */
    public function update(UpdateBudgetRequest $request, Budget $budget): JsonResponse
    {
        $validated = $request->validated();
        $budget->update($validated);

        event(new BudgetModified($budget, $request->user(), 'updated'));
        $budget->load(['governmentUnit', 'fiscalYear']);

        return $this->resourceResponse(new BudgetResource($budget), 'Budget updated successfully');
    }

    /**
     * Delete budget
     * 
     * @authenticated
     */
    public function destroy(Request $request, Budget $budget): JsonResponse
    {
        event(new BudgetModified($budget, $request->user(), 'deleted'));
        $budget->delete();

        return $this->success(null, 'Budget deleted successfully', 200);
    }
}

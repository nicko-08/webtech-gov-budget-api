<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BudgetCategoryResource;
use App\Models\BudgetCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

/**
 * @group Budget Categories
 * Budget category management endpoints  
 */
class BudgetCategoryController extends Controller
{
    use ApiResponse;

    /**
     * List budget categories
     */
    public function index(): AnonymousResourceCollection
    {
        return BudgetCategoryResource::collection(BudgetCategory::all());
    }

    /**
     * Create budget category
     * 
     * @authenticated
     * @bodyParam name string required Category name. Example: Office Supplies
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:budget_categories,name'],
        ]);

        $category = BudgetCategory::create($validated);

        return $this->resourceResponse(new BudgetCategoryResource($category), 'Budget category created successfully', 201);
    }

    /**
     * Show budget category
     */
    public function show(BudgetCategory $budgetCategory): BudgetCategoryResource
    {
        return new BudgetCategoryResource($budgetCategory);
    }

    /**
     * Update budget category
     * 
     * @authenticated
     * @bodyParam name string Category name. Example: Office Equipment
     */
    public function update(Request $request, BudgetCategory $budgetCategory): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('budget_categories', 'name')->ignore($budgetCategory->id)],
        ]);

        $budgetCategory->update($validated);

        return $this->resourceResponse(new BudgetCategoryResource($budgetCategory), 'Budget category updated successfully');
    }

    /**
     * Delete budget category
     * 
     * @authenticated
     */
    public function destroy(BudgetCategory $budgetCategory): JsonResponse
    {
        $budgetCategory->delete();

        return $this->success(null, 'Budget category deleted successfully', 200);
    }
}

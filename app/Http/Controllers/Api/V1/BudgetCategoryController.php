<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBudgetCategoryRequest;
use App\Http\Requests\UpdateBudgetCategoryRequest;
use App\Http\Resources\BudgetCategoryResource;
use App\Models\BudgetCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Budget Categories
 * Budget category management endpoints
 */
class BudgetCategoryController extends Controller
{
    /**
     * List budget categories
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', BudgetCategory::class);

        return BudgetCategoryResource::collection(
            BudgetCategory::query()->latest()->get()
        );
    }

    /**
     * Create budget category
     *
     * @authenticated
     *
     * @bodyParam name string required Category name. Example: Office Supplies
     */
    public function store(StoreBudgetCategoryRequest $request): Response
    {
        $this->authorize('create', BudgetCategory::class);

        $category = BudgetCategory::create($request->validated());

        return (new BudgetCategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show budget category
     */
    public function show(BudgetCategory $budgetCategory): BudgetCategoryResource
    {
        $this->authorize('view', $budgetCategory);

        return new BudgetCategoryResource($budgetCategory);
    }

    /**
     * Update budget category
     *
     * @authenticated
     *
     * @bodyParam name string Category name. Example: Office Equipment
     */
    public function update(UpdateBudgetCategoryRequest $request, BudgetCategory $budgetCategory): BudgetCategoryResource
    {
        $this->authorize('update', $budgetCategory);

        $budgetCategory->update($request->validated());

        return new BudgetCategoryResource($budgetCategory);
    }

    /**
     * Delete budget category
     *
     * @authenticated
     */
    public function destroy(BudgetCategory $budgetCategory): Response
    {
        $this->authorize('delete', $budgetCategory);

        $budgetCategory->delete();

        return response()->noContent();
    }
}

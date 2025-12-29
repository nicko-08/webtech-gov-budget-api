<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\BudgetItemModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBudgetItemRequest;
use App\Http\Requests\UpdateBudgetItemRequest;
use App\Http\Resources\BudgetItemResource;
use App\Models\BudgetItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Jobs\RecalculateBudgetAnalytics;

/**
 * @group Budget Items
 * Budget item management endpoints
 */
class BudgetItemController extends Controller
{
    private const PER_PAGE = 20;

    /**
     * List budget items
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('viewAny', BudgetItem::class);

        $budgetItems = BudgetItem::query()
            ->with(['budget', 'category'])
            ->when(
                $request->filled('budget_id'),
                fn($query) => $query->where(
                    'budget_id',
                    $request->integer('budget_id')
                )
            )
            ->latest()
            ->paginate(self::PER_PAGE);

        return BudgetItemResource::collection($budgetItems);
    }

    /**
     * Create budget item
     *
     * @authenticated
     */
    public function store(StoreBudgetItemRequest $request): JsonResponse
    {
        $this->authorize('create', BudgetItem::class);

        $budgetItem = BudgetItem::create($request->validated());

        event(new BudgetItemModified(
            $budgetItem,
            $request->user(),
            'created'
        ));

        return (new BudgetItemResource(
            $budgetItem->load(['budget', 'category'])
        ))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show budget item
     */
    public function show(BudgetItem $budgetItem): BudgetItemResource
    {
        $this->authorize('view', $budgetItem);

        $budgetItem
            ->load(['budget', 'category'])
            ->loadSum('expenses', 'amount');

        return new BudgetItemResource($budgetItem);
    }

    /**
     * Update budget item
     *
     * @authenticated
     */
    public function update(UpdateBudgetItemRequest $request, BudgetItem $budgetItem): BudgetItemResource
    {
        $this->authorize('update', $budgetItem);

        $budgetItem->update($request->validated());

        event(new BudgetItemModified(
            $budgetItem,
            $request->user(),
            'updated'
        ));

        return new BudgetItemResource(
            $budgetItem->fresh(['budget', 'category'])
        );
    }

    /**
     * Delete budget item
     *
     * @authenticated
     */
    public function destroy(Request $request, BudgetItem $budgetItem): Response
    {
        $this->authorize('delete', $budgetItem);

        DB::transaction(function () use ($budgetItem, $request) {
            $governmentUnitId = $budgetItem->budget->government_unit_id;
            $fiscalYearId = $budgetItem->budget->fiscal_year_id;

            $budgetItem->delete();

            event(new BudgetItemModified(
                $budgetItem,
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

    /**
     * Get budget item summary
     */
    public function summary(BudgetItem $budgetItem): JsonResponse
    {
        $budgetItem
            ->load('budget:id,name')
            ->loadSum('expenses', 'amount');

        $spent = $budgetItem->expenses_sum_amount ?? 0;
        $allocated = $budgetItem->allocated_amount;

        return response()->json([
            'name' => $budgetItem->name,
            'code' => $budgetItem->code,
            'allocated_amount' => $allocated,
            'spent_amount' => $spent,
            'utilization_percentage' => $allocated > 0
                ? round(($spent / $allocated) * 100, 2)
                : 0,
            'budget' => [
                'name' => $budgetItem->budget->name,
            ],
        ]);
    }
}

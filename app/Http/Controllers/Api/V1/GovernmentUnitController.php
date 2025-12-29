<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\GovernmentUnitModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGovernmentUnitRequest;
use App\Http\Requests\UpdateGovernmentUnitRequest;
use App\Http\Resources\GovernmentUnitResource;
use App\Models\GovernmentUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

/**
 * @group Government Units
 * Government unit management endpoints
 */
class GovernmentUnitController extends Controller
{
    /**
     * List government units
     */
    public function index(): AnonymousResourceCollection
    {
        return GovernmentUnitResource::collection(
            GovernmentUnit::query()
                ->with('parent')
                ->latest()
                ->paginate(20)
        );
    }

    /**
     * Create government unit
     *
     * @authenticated
     *
     * @bodyParam name string required Unit name. Example: Barangay Commonwealth
     * @bodyParam type string required Unit type. Example: Barangay
     * @bodyParam parent_id integer Parent unit ID. Example: 1
     */
    public function store(StoreGovernmentUnitRequest $request): JsonResponse
    {
        $this->authorize('create', GovernmentUnit::class);

        $unit = GovernmentUnit::create($request->validated());

        event(new GovernmentUnitModified(
            $unit,
            $request->user(),
            'created'
        ));

        return (new GovernmentUnitResource($unit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show government unit
     */
    public function show(GovernmentUnit $governmentUnit): GovernmentUnitResource
    {
        $governmentUnit->load(['parent', 'children']);

        return new GovernmentUnitResource($governmentUnit);
    }

    /**
     * Update government unit
     *
     * @authenticated
     */
    public function update(
        UpdateGovernmentUnitRequest $request,
        GovernmentUnit $governmentUnit
    ): GovernmentUnitResource {

        $this->authorize('update', $governmentUnit);

        $governmentUnit->update($request->validated());

        event(new GovernmentUnitModified(
            $governmentUnit,
            $request->user(),
            'updated'
        ));

        return new GovernmentUnitResource($governmentUnit->fresh(['parent', 'children']));
    }

    /**
     * Delete government unit
     *
     * @authenticated
     */
    public function destroy(Request $request, GovernmentUnit $governmentUnit): Response
    {
        $this->authorize('delete', $governmentUnit);

        if ($governmentUnit->children()->exists()) {
            return response()->json([
                'message' => 'Cannot delete a government unit that has sub-units.',
            ], Response::HTTP_CONFLICT);
        }

        DB::transaction(function () use ($governmentUnit, $request) {
            $governmentUnitId = $governmentUnit->id;

            $governmentUnit->delete();

            event(new GovernmentUnitModified(
                $governmentUnit,
                $request->user(),
                'deleted'
            ));

            /**
             * Explicit cache invalidation
             * No recalculation needed — data is gone
             */
            Cache::forget("analytics:barangay:{$governmentUnitId}");
            Cache::forget('analytics:barangay-list');
            Cache::forget('analytics:overall-summary');
        });

        return response()->noContent();
    }
}

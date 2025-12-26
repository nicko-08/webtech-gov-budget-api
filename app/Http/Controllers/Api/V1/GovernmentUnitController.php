<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\GovernmentUnitModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGovernmentUnitRequest;
use App\Http\Requests\UpdateGovernmentUnitRequest;
use App\Http\Resources\GovernmentUnitResource;
use App\Models\GovernmentUnit;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Government Units  
 * Government unit management endpoints
 */
class GovernmentUnitController extends Controller
{
    use ApiResponse;

    /**
     * List government units
     */
    public function index(): AnonymousResourceCollection
    {
        $units = GovernmentUnit::with('parent')->latest()->paginate(20);
        return GovernmentUnitResource::collection($units);
    }

    /**
     * Create government unit
     * 
     * @authenticated
     * @bodyParam name string required Unit name. Example: Department of Finance
     * @bodyParam type string required Unit type. Example: department
     * @bodyParam parent_id integer Parent unit ID. Example: 1
     */
    public function store(StoreGovernmentUnitRequest $request): JsonResponse
    {
        $unit = GovernmentUnit::create($request->validated());
        event(new GovernmentUnitModified($unit, $request->user(), 'created'));

        return $this->resourceResponse(new GovernmentUnitResource($unit), 'Government unit created successfully', 201);
    }

    /**
     * Show government unit
     * 
     */
    public function show(GovernmentUnit $governmentUnit): GovernmentUnitResource
    {
        $governmentUnit->load('parent', 'children');
        return new GovernmentUnitResource($governmentUnit);
    }

    /**
     * Update government unit
     * 
     * @authenticated
     */
    public function update(UpdateGovernmentUnitRequest $request, GovernmentUnit $governmentUnit): JsonResponse
    {
        $governmentUnit->update($request->validated());
        event(new GovernmentUnitModified($governmentUnit, $request->user(), 'updated'));

        return $this->resourceResponse(new GovernmentUnitResource($governmentUnit->fresh()), 'Government unit updated successfully');
    }

    /**
     * Delete government unit
     * 
     * @authenticated
     */
    public function destroy(Request $request, GovernmentUnit $governmentUnit): JsonResponse
    {
        if ($governmentUnit->children()->exists()) {
            return $this->error('Cannot delete a government unit that has sub-units. Please re-assign or delete them first.', 409);
        }

        event(new GovernmentUnitModified($governmentUnit, $request->user(), 'deleted'));
        $governmentUnit->delete();

        return $this->success(null, 'Government unit deleted successfully', 200);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\FiscalYearModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFiscalYearRequest;
use App\Http\Requests\UpdateFiscalYearRequest;
use App\Http\Resources\FiscalYearResource;
use App\Models\FiscalYear;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

/**
 * @group Fiscal Years
 * Fiscal year management endpoints
 */
class FiscalYearController extends Controller
{
    use ApiResponse;

    /**
     * List fiscal years
     */
    public function index(): AnonymousResourceCollection
    {
        return FiscalYearResource::collection(FiscalYear::orderBy('year', 'desc')->paginate(20));
    }

    /**
     * Create fiscal year
     * 
     * @authenticated
     * @bodyParam year integer required Fiscal year. Example: 2024
     * @bodyParam start_date date required Start date. Example: 2024-01-01
     * @bodyParam end_date date required End date. Example: 2024-12-31
     * @bodyParam is_active boolean Active status. Example: true
     */
    public function store(StoreFiscalYearRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $fiscalYear = null;

        DB::transaction(function () use ($validated, &$fiscalYear, $request) {
            if (isset($validated['is_active']) && $validated['is_active']) {
                FiscalYear::where('is_active', true)->update(['is_active' => false]);
            }
            $fiscalYear = FiscalYear::create($validated);

            // Only fire event if user is authenticated
            if ($request->user()) {
                event(new FiscalYearModified($fiscalYear, $request->user(), 'created'));
            }
        });

        return $this->resourceResponse(new FiscalYearResource($fiscalYear), 'Fiscal year created successfully', 201);
    }

    /**
     * Show fiscal year
     * 
     */
    public function show(FiscalYear $fiscalYear): FiscalYearResource
    {
        return new FiscalYearResource($fiscalYear);
    }

    /**
     * Update fiscal year
     * 
     * @authenticated
     * @response 200 {
     *   "success": true,
     *   "message": "Fiscal year updated successfully",
     *   "data": {
     *     "id": 1,
     *     "year": 2024,
     *     "start_date": "2024-01-01",
     *     "end_date": "2024-12-31",
     *     "is_active": true
     *   }
     * }
     */
    public function update(UpdateFiscalYearRequest $request, FiscalYear $fiscalYear): JsonResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $fiscalYear, $request) {
            if (isset($validated['is_active']) && $validated['is_active']) {
                FiscalYear::where('is_active', true)->where('id', '!=', $fiscalYear->id)->update(['is_active' => false]);
            }
            $fiscalYear->update($validated);

            // Only fire event if user is authenticated
            if ($request->user()) {
                event(new FiscalYearModified($fiscalYear, $request->user(), 'updated'));
            }
        });

        return $this->resourceResponse(new FiscalYearResource($fiscalYear->fresh()), 'Fiscal year updated successfully');
    }

    /**
     * Delete fiscal year
     * 
     * @authenticated
     */
    public function destroy(Request $request, FiscalYear $fiscalYear): JsonResponse
    {
        // Only fire event if user is authenticated
        if ($request->user()) {
            event(new FiscalYearModified($fiscalYear, $request->user(), 'deleted'));
        }

        $fiscalYear->delete();

        return $this->success(null, 'Fiscal year deleted successfully', 200);
    }
}

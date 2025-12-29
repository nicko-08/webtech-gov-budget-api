<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\FiscalYearModified;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFiscalYearRequest;
use App\Http\Requests\UpdateFiscalYearRequest;
use App\Http\Resources\FiscalYearResource;
use App\Models\FiscalYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Fiscal Years
 * Fiscal year management endpoints
 */
class FiscalYearController extends Controller
{
    /**
     * List fiscal years
     */
    public function index(): AnonymousResourceCollection
    {
        return FiscalYearResource::collection(
            FiscalYear::query()
                ->orderByDesc('year')
                ->paginate(20)
        );
    }

    /**
     * Create fiscal year
     *
     * @authenticated
     *
     * @bodyParam year integer required Fiscal year. Example: 2024
     * @bodyParam start_date date required Start date. Example: 2024-01-01
     * @bodyParam end_date date required End date. Example: 2024-12-31
     * @bodyParam is_active boolean Active status. Example: true
     */
    public function store(StoreFiscalYearRequest $request): JsonResponse
    {
        $this->authorize('create', FiscalYear::class);

        $fiscalYear = DB::transaction(function () use ($request) {
            if ($request->boolean('is_active')) {
                FiscalYear::where('is_active', true)
                    ->update(['is_active' => false]);
            }

            $model = FiscalYear::create($request->validated());

            event(new FiscalYearModified(
                $model,
                $request->user(),
                'created'
            ));

            return $model;
        });

        return (new FiscalYearResource($fiscalYear))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show fiscal year
     */
    public function show(FiscalYear $fiscalYear): FiscalYearResource
    {
        return new FiscalYearResource($fiscalYear);
    }

    /**
     * Update fiscal year
     *
     * @authenticated
     *
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
    public function update(UpdateFiscalYearRequest $request, FiscalYear $fiscalYear): FiscalYearResource
    {
        $this->authorize('update', $fiscalYear);

        DB::transaction(function () use ($request, $fiscalYear) {
            if ($request->boolean('is_active')) {
                FiscalYear::where('is_active', true)
                    ->whereKeyNot($fiscalYear->id)
                    ->update(['is_active' => false]);
            }

            $fiscalYear->update($request->validated());

            event(new FiscalYearModified(
                $fiscalYear,
                $request->user(),
                'updated'
            ));
        });

        return new FiscalYearResource($fiscalYear->fresh());
    }

    /**
     * Delete fiscal year
     *
     * @authenticated
     */
    public function destroy(Request $request, FiscalYear $fiscalYear): Response
    {
        $this->authorize('delete', $fiscalYear);

        DB::transaction(function () use ($fiscalYear, $request) {
            $fiscalYear->delete();

            event(new FiscalYearModified(
                $fiscalYear,
                $request->user(),
                'deleted'
            ));
        });

        return response()->noContent();
    }
}

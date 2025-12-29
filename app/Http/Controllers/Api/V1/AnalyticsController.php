<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnalyticsResource;
use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Public Analytics
 *
 * Read-only analytics endpoints for public budget transparency.
 */
final class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnalyticsService $analytics
    ) {}

    public function overallSummary(): JsonResponse
    {
        $summary = $this->analytics->overallSummary();

        if (! $summary) {
            return response()->json([
                'message' => 'No active fiscal year or summary data available.',
            ], Response::HTTP_NOT_FOUND);
        }

        return (new AnalyticsResource($summary))->response();
    }

    public function barangayList(): JsonResponse
    {
        return response()->json(
            $this->analytics->barangayList()
        );
    }

    public function barangayAnalytics(int $budgetId): JsonResponse
    {
        $data = $this->analytics->barangayAnalytics($budgetId);

        if (! $data) {
            return response()->json([
                'message' => 'Barangay not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($data);
    }
}

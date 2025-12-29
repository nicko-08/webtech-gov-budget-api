<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuditLogIndexRequest;
use App\Http\Resources\AuditLogResource;
use App\Models\AuditLog;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Audit Logs
 *
 * Read-only audit trail endpoints for administrators and auditors.
 */
final class AuditLogController extends Controller
{
    /**
     * List audit logs
     *
     * Returns a paginated list of audit logs.
     * Accessible to admins and auditors.
     *
     * @authenticated
     */
    public function index(
        AuditLogIndexRequest $request
    ): AnonymousResourceCollection {
        $this->authorize('viewAny', AuditLog::class);

        $query = AuditLog::query()
            ->with('user')
            ->latest();

        if ($request->filled('user_id')) {
            $query->byUser($request->integer('user_id'));
        }

        if ($request->filled('resource')) {
            $query->forResource($request->string('resource'));
        }

        if ($request->filled('action')) {
            $query->where('action', $request->string('action'));
        }

        if ($request->filled('date')) {
            $query->whereDate(
                'created_at',
                $request->date('date')
            );
        } else {
            if ($request->filled('from')) {
                $query->whereDate('created_at', '>=', $request->date('from'));
            }

            if ($request->filled('to')) {
                $query->whereDate('created_at', '<=', $request->date('to'));
            }
        }

        return AuditLogResource::collection(
            $query->paginate(
                $request->integer('per_page', 25)
            )
        );
    }

    /**
     * View a specific audit log
     *
     * @authenticated
     *
     * @urlParam auditLog integer required The ID of the audit log. Example: 1
     */
    public function show(AuditLog $auditLog): AuditLogResource
    {
        $this->authorize('view', $auditLog);

        return new AuditLogResource(
            $auditLog->load('user')
        );
    }

    /**
     * List audit logs for a specific date
     *
     * Explicit auditor-friendly endpoint.
     *
     * @authenticated
     *
     * @queryParam date date required Filter audit logs by date (YYYY-MM-DD). Example: 2025-12-28
     * @queryParam per_page integer Number of records per page (max 100). Example: 25
     */
    public function byDate(
        AuditLogIndexRequest $request
    ): AnonymousResourceCollection {
        $this->authorize('viewAny', AuditLog::class);

        // Ensure date is present for this route
        $request->validate([
            'date' => ['required', 'date'],
        ]);

        $query = AuditLog::query()
            ->with('user')
            ->whereDate('created_at', $request->date('date'))
            ->latest();

        return AuditLogResource::collection(
            $query->paginate(
                $request->integer('per_page', 25)
            )
        );
    }
}

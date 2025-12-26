<?php

namespace App\Listeners;

use App\Models\AuditLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogModelModification implements ShouldQueue
{
    public function handle(object $event): void
    {
        if (!isset($event->model) || !isset($event->user) || !isset($event->action)) {
            return;
        }

        try {
            $model = $event->model;
            $details = $this->getDetails($model, $event->action);

            AuditLog::create([
                'user_id' => $event->user->id,
                'action' => $event->action,
                'auditable_id' => $model->id,
                'auditable_type' => get_class($model),
                'details' => $details,
                'ip_address' => request()?->ip(),
                'created_at' => now()
            ]);

            // Log critical actions to application logs
            if ($this->isCriticalAction($model, $event->action)) {
                Log::info('Critical action performed', [
                    'user_id' => $event->user->id,
                    'action' => $event->action,
                    'resource' => class_basename($model),
                    'resource_id' => $model->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Audit logging failed', [
                'error' => $e->getMessage(),
                'user_id' => $event->user->id ?? null,
                'action' => $event->action ?? null
            ]);
        }
    }

    private function getDetails($model, string $action): ?array
    {
        return match ($action) {
            'updated' => [
                'before' => $model->getOriginal(),
                'after' => $model->getChanges(),
            ],
            'deleted' => $model->toArray(),
            default => null
        };
    }

    private function isCriticalAction($model, string $action): bool
    {
        $criticalModels = ['Budget', 'User', 'Expense'];
        $criticalActions = ['created', 'deleted'];

        return in_array(class_basename($model), $criticalModels) &&
            in_array($action, $criticalActions);
    }
}

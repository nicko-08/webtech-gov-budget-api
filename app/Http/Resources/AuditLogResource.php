<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class AuditLogResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'action' => $this->action,
            'performed_by' => [
                'id' => $this->user_id,
                'name' => $this->user?->name,
                'role' => $this->user?->role,
            ],
            'resource' => class_basename($this->auditable_type),
            'resource_id' => $this->auditable_id,
            'details' => $this->details,
            'ip_address' => $this->ip_address,
            'performed_at' => $this->created_at->toIso8601String(),
        ];
    }
}

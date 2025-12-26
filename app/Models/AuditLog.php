<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'auditable_id',
        'auditable_type',
        'details',
        'ip_address',
        'created_at'
    ];

    protected $casts = [
        'details' => 'array',
        'created_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auditable()
    {
        return $this->morphTo();
    }

    // Scope for filtering by resource type
    public function scopeForResource($query, string $resourceType)
    {
        return $query->where('auditable_type', $resourceType);
    }

    // Scope for filtering by user
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}

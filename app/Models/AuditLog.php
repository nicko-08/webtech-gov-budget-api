<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'auditable_id',
        'auditable_type',
        'details',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'auditable_id' => 'integer',
            'details' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeForResource(Builder $query, string $resource): Builder
    {
        if (! str_contains($resource, '\\')) {
            $resource = 'App\\Models\\' . $resource;
        }

        return $query->where('auditable_type', $resource);
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    // Prevent accidental updates, deletes, or cleanups
    protected static function booted(): void
    {
        static::updating(fn() => false);
        static::deleting(fn() => false);
    }
}

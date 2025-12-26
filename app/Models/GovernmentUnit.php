<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GovernmentUnit extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(GovernmentUnit::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(GovernmentUnit::class, 'parent_id');
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }
}

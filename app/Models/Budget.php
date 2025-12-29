<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'government_unit_id',
        'fiscal_year_id',
        'total_amount',
    ];

    protected function casts(): array
    {
        return [
            'government_unit_id' => 'integer',
            'fiscal_year_id' => 'integer',
            'total_amount' => 'decimal:2',
        ];
    }

    public function governmentUnit(): BelongsTo
    {
        return $this->belongsTo(GovernmentUnit::class);
    }

    public function fiscalYear(): BelongsTo
    {
        return $this->belongsTo(FiscalYear::class);
    }

    public function budgetItems(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }
}

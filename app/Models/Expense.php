<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'budget_item_id',
        'amount',
        'transaction_date',
    ];

    protected function casts(): array
    {
        return [
            'budget_item_id' => 'integer',
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    public function budgetItem(): BelongsTo
    {
        return $this->belongsTo(BudgetItem::class);
    }
}

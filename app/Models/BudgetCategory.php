<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function budgetItems(): HasMany
    {
        return $this->hasMany(BudgetItem::class);
    }
}

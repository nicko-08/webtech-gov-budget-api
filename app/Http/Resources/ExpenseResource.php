<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'amount' => (float) $this->amount,
            'transaction_date' => $this->transaction_date,
            'budget_item' => new BudgetItemResource($this->whenLoaded('budgetItem')),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'allocated_amount' => (float) $this->allocated_amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Conditionally load relationships to prevent N+1 problems
            'budget' => new BudgetResource($this->whenLoaded('budget')),
            'category' => new BudgetCategoryResource($this->whenLoaded('category')),
            // Conditionally load aggregated sums
            'spent_amount' => $this->whenAggregated('expenses', 'amount', 'sum'),
        ];
    }
}

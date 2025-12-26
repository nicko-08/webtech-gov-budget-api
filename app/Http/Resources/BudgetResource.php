<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GovernmentUnitResource;
use App\Http\Resources\FiscalYearResource;
use App\Http\Resources\BudgetItemResource;

class BudgetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'total_amount' => (float) $this->total_amount,
            'government_unit' => new GovernmentUnitResource($this->whenLoaded('governmentUnit')),
            'fiscal_year' => new FiscalYearResource($this->whenLoaded('fiscalYear')),
            'budget_items' => BudgetItemResource::collection($this->whenLoaded('items')),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'total_allocated' => (float) $this->total_allocated,
            'total_spent' => (float) $this->total_spent,
            'utilization_rate' => (float) $this->utilization_rate,
            'remaining_budget' => (float) ($this->total_allocated - $this->total_spent),
            'spending_by_category' => json_decode($this->spending_by_category, true) ?? [],
        ];
    }
}

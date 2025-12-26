<?php

namespace Database\Factories;

use App\Models\FiscalYear;
use App\Models\GovernmentUnit;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'government_unit_id' => GovernmentUnit::factory(),
            'fiscal_year_id' => FiscalYear::factory(),
            'name' => 'Annual Budget',
            'total_amount' => fake()->numberBetween(1000000, 1000000000),
        ];
    }
}

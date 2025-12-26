<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\BudgetCategory;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BudgetItem>
 */
class BudgetItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'budget_id' => Budget::factory(),
            'budget_category_id' => BudgetCategory::factory(),
            'name' => 'Program/Project - ' . fake()->words(2, true),
            'code' => fake()->unique()->bothify('??##-####'),
            'allocated_amount' => fake()->numberBetween(50000, 5000000),
        ];
    }
}

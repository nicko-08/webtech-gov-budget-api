<?php

namespace Database\Factories;

use App\Models\BudgetItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'budget_item_id' => BudgetItem::factory(),
            'description' => fake()->sentence(),
            'amount' => fake()->numberBetween(1000, 10000),
            'transaction_date' => fake()->dateTimeThisYear(),
        ];
    }
}

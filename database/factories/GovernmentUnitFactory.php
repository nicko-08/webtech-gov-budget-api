<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GovernmentUnit>
 */
class GovernmentUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Department',
            'type' => $this->faker->randomElement(['department', 'agency', 'bureau']),
            'parent_id' => null, // Default to being a top-level unit
        ];
    }
}

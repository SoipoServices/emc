<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'slug' => fake()->slug(),
            'description' => fake()->realText(),
            'address' => fake()->address(),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime(),
            'is_approved' => fake()->boolean(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

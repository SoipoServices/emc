<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company();
        
        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => $this->faker->paragraph(3),
            'email' => $this->faker->companyEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'url' => $this->faker->url(),
            'linkedin_url' => $this->faker->url(),
            'priority' => $this->faker->numberBetween(0, 10),
            'is_approved' => $this->faker->boolean(),
            'is_public' => $this->faker->boolean(),
            'is_sponsor' => $this->faker->boolean(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

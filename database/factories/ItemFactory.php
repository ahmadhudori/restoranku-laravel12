<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
			'description' => $this->faker->sentence(),
			'price' => $this->faker->randomFloat(2, 1000, 100000),
			'category_id' => $this->faker->numberBetween(1, 2), // Assuming you have a Category model and factory
			'image' => $this->faker->imageUrl(640, 480, 'food'),
			'is_active' => $this->faker->boolean(),
			'created_at' => now(),
			'updated_at' => now(),
			'deleted_at' => null, // Soft delete field
        ];
    }
}

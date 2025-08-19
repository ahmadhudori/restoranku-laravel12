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
			'image' => fake()->randomElement([
				'https://plus.unsplash.com/premium_photo-1694547926001-f2151e4a476b',
				'https://plus.unsplash.com/premium_photo-1668143358351-b20146dbcc02',
				'https://images.unsplash.com/photo-1633790450512-98e68a55ef15'
			]),
			'is_active' => $this->faker->boolean(),
			'created_at' => now(),
			'updated_at' => now(),
			'deleted_at' => null, // Soft delete field
        ];
    }
}

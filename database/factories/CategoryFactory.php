<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryName = fake()->sentence(1);

        return [
            'category_name' => $categoryName,
            'category_slug' => Str::slug($categoryName),
            'category_image' => fake()->imageUrl(640, 480, 'category', true),
        ];
    }
}

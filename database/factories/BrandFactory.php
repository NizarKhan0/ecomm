<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brandName = fake()->company;
        return [
            'brand_name' => $brandName,
            'brand_slug' => Str::slug($brandName),
            'brand_image' => fake()->imageUrl(640, 480, 'nature', true),
        ];
    }
}

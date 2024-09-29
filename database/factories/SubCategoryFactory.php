<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Assuming you have some categories in your database
        $category = Category::inRandomOrder()->first();

        $subcategoryName = $this->faker->sentence(1);

        return [
            'category_id' => $category->id, // Assign a random existing category ID
            'subcategory_name' => $subcategoryName,
            'subcategory_slug' => Str::slug($subcategoryName),
        ];
    }
}

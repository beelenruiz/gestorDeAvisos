<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake() -> sentence(3, true),
            'description' => fake() -> text(100),
            'brand' => fake() -> sentence(1),
            'price' => fake() -> randomFloat(2, 10, 200),
            'stock' => fake() -> numberBetween(0, 100),
            'category_id' => Category::all() -> random() -> id
        ];
    }
}

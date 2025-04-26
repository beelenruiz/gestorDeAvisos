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
        fake() -> addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        $colors = [
            'rojo' => '#c0392b',
            'azul' => '#3498db',
            'verde' => '#229954',
            'amarillo' => '#f1c40f',
            'negro' => '#000000',
            'blanco' => '#FFFFFF',
            'gris' => '#7f8c8d',
            'naranja' => '#f39c12',
            'rosa' => '#f1948a',
            'morado' => '#9b59b6'
        ];
        $cantColors = fake() -> randomElement([2, 4, 6]);

        return [
            'name' => fake() -> sentence(3, true),
            'description' => fake() -> text(100),
            'colors'=> fake() -> randomElements($colors, $cantColors),
            'brand' => fake() -> sentence(1),
            'price' => fake() -> randomFloat(2, 10, 200),
            'stock' => fake() -> numberBetween(0, 100),
            'images' => [$this -> generateImageUrl(), $this -> generateImageUrl(), $this -> generateImageUrl(),$this -> generateImageUrl(), $this -> generateImageUrl()],
            'category_id' => Category::all() -> random() -> id
        ];
    }

    private function generateImageUrl()
    {
        return 'images/articles/'. fake() -> picsum('public/storage/images/articles', 500, 600, false);
    }
}

<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => fake() -> randomElement(['completado', 'aceptado', 'cancelado', 'pendiente']),
            'price' => fake() ->randomFloat(2, 10, 500),
            'company_id' => Company::all() -> random() -> id
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'state' => fake() -> randomElement(['procesando', 'aceptada', 'cancelada', 'en espera', 'completada']),
            'description' => fake() -> text(),
            'company_id' => Company::all() -> random() -> id,
            'machine_id' => Machine::all() -> random() -> id,
        ];
    }
}

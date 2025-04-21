<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
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
            'color' => fake() -> randomElement([true, false]),
            'n_serial' => fake() -> numberBetween(100000, 999999),
            'type' => fake() -> randomElement(['inyeccion de tinta', 'laser', 'termica', 'matricial', '3d', 'multifuncional']),
            'company_id' => Company::all() -> random() -> id,
        ];
    }
}

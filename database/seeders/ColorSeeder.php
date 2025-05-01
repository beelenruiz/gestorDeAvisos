<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        foreach($colors as $name => $color){
            Color::create(compact('name', 'color'));
        }
    }
}

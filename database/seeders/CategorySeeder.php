<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'sillas de oficina',
             'description' => 'Disponemos de una amplia variedad de sillas de oficina que destacan por su comodidad y adaptabilidad a las necesidades del usuario. Todas estas sillas están fabricadas con materiales de primera calidad y su diseño garantiza el bienestar de las personas.  ',
              'icon' => 'images/iconsCategories/silla-de-oficina.png'
            ],
            ['name' => 'silas de colectividades',
             'description' => ' Todas nuestras sillas están diseñadas para ofrecer el máximo confort a sus usuarios. Además, destacan por su versatilidad y polivalencia. Cabe mencionar que todas estas sillas están hechas de materiales resistentes y ligeros para poder darles un uso tanto interior como exterior y ofrecen la posibilidad de transportarlas y almacenarlas de forma sencilla.',
              'icon' => 'images/iconsCategories/silla-plegable.png'
            ],
            ['name' => 'mesas',
             'description' => 'Contamos con una amplia variedad de mesas de oficina diseñadas para crear espacios de trabajo únicos donde predominen el confort y la productividad. Todas nuestras mesas destacan por su adaptabilidad y funcionalidad.',
              'icon' => 'images/iconsCategories/mesa.png'
            ],
            ['name' => 'mostradores',
             'description' => 'Nuestro mostradores destacan por su diseño ergonómico y adaptabilidad al entorno. Asimismo, ofrecen una amplia variedad de colores que conceden una perfecta luminosidad y acabados.',
              'icon' => 'images/iconsCategories/mostrador.png'
            ],
            ['name' => 'armarios',
             'description' => 'Nuestros armarios para oficina destacan por su gran capacidad de almacenamiento sin dejar de lado su diseño elegante. Disponemos de una gran variedad de armarios con distintos tamaños y funciones. También contamos con cajoneras para oficina para poder almacenar y clasificar la documentación. Estas cajoneras son ideales para espacios pequeños.',
              'icon' => 'images/iconsCategories/armario.png'
            ],
            ['name' => 'sillones',
             'description' => 'Nuestros sillones de oficina tienen como objetivo crear un ambiente de relajación para que los trabajadores puedan desconectar pero sin perder la productividad. Estos sillones aseguran el bienestar de los usuarios y favorecen la comunicación entre los mismos.',
              'icon' => 'images/iconsCategories/sillon.png'
            ],
        ];

        foreach ($categories as $category){
            Category::create($category);
        }
    }
}

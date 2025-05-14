<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $machines = [
            [
                'name' => 'HP LaserJet Pro',
                'color' => true,
                'n_serial' => 'HP1234567',
                'type' => 'laser',
                'image' => 'images/machines/HP LaserJet Pro.png',
                'company_id' => 1,
            ],
            [
                'name' => 'Canon Pixma',
                'color' => false,
                'n_serial' => 'CN9876543',
                'type' => 'inyeccion de tinta',
                'image' => 'images/machines/Canon Pixma.png',
                'company_id' => 2,
            ],
            [
                'name' => 'Epson EcoTank',
                'color' => true,
                'n_serial' => 'EP4567890',
                'type' => 'inyeccion de tinta',
                'image' => 'images/machines/Epson EcoTank.png',
                'company_id' => 3,
            ],
            [
                'name' => 'Brother DCP-L2550DW',
                'color' => false,
                'n_serial' => 'BR1239876',
                'type' => 'multifuncional',
                'image' => 'images/machines/Brother DCP-L2550DW.png',
                'company_id' => 4,
            ],
            [
                'name' => 'Samsung Xpress',
                'color' => true,
                'n_serial' => 'SS8765432',
                'type' => 'laser',
                'image' => 'images/machines/Samsung Xpress.png',
                'company_id' => 5,
            ],
            [
                'name' => 'Ricoh SP C250DN',
                'color' => true,
                'n_serial' => 'RC3456721',
                'type' => 'termica',
                'image' => 'images/machines/Ricoh SP C250DN.png',
                'company_id' => null,
            ],
            [
                'name' => 'Lexmark MB2236adw',
                'color' => false,
                'n_serial' => 'LX2345678',
                'type' => 'multifuncional',
                'image' => 'images/machines/Lexmark MB2236adw.png',
                'company_id' => 1,
            ],
            [
                'name' => 'Kyocera Ecosys',
                'color' => true,
                'n_serial' => 'KC0987654',
                'type' => 'matricial',
                'image' => 'images/machines/Kyocera Ecosys.png',
                'company_id' => null,
            ],
            [
                'name' => 'Dell C1760NW',
                'color' => false,
                'n_serial' => 'DL1234567',
                'type' => '3d',
                'image' => 'images/machines/Dell C1760NW.png',
                'company_id' => 3,
            ],
            [
                'name' => 'Xerox Phaser 6510',
                'color' => true,
                'n_serial' => 'XR6543210',
                'type' => 'laser',
                'image' => 'images/machines/Xerox Phaser 6510.png',
                'company_id' => 4,
            ],
        ];

        foreach ($machines as $machine) {
            Machine::create($machine);
        }
    }
}

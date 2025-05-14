<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Admins
            ['name' => 'Carlos Gómez', 'email' => 'webmaster@solutech.com'],
            ['name' => 'María Sánchez', 'email' => 'suported@solutech.com'],
            
            // Workers
            ['name' => 'Laura Méndez', 'email' => 'laura.mendez@solutech.com'],
            ['name' => 'Carlos Pérez', 'email' => 'carlos.perez@solutech.com'],
            ['name' => 'Ana Torres', 'email' => 'ana.torres@solutech.com'],
            ['name' => 'Javier López', 'email' => 'javier.lopez@solutech.com'],
            
            // Empresas con nombres inventados y dominios correspondientes
            ['name' => 'TechPro Solutions', 'email' => 'contacto@techprosolutions.com'],
            ['name' => 'GreenCorp', 'email' => 'info@greencorp.com'],
            ['name' => 'InnovateX', 'email' => 'rrhh@innovatex.es'],
            ['name' => 'SmartTech Inc.', 'email' => 'contacto@smarttechinc.com'],
            ['name' => 'BlueSky Ventures', 'email' => 'contacto@blueskyventures.es'],
        ];
    
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}

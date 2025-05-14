<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['user_id' => 7,  'phone' => '911-123-456'],
            ['user_id' => 8,  'phone' => '922-456-789'],
            ['user_id' => 9,  'phone' => '933-789-012'],
            ['user_id' => 10, 'phone' => '944-012-345'],
            ['user_id' => 11, 'phone' => '955-345-678'],
        ];

        foreach ($companies as $company) {
            Company::create([
                'user_id' => $company['user_id'],
                'phone' => $company['phone'],
            ]);
        }
    }
}

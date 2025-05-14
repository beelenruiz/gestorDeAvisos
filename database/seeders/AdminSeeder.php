<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminIds = [1, 2];

        foreach ($adminIds as $id) {
            Admin::create([
                'user_id' => $id,
            ]);
        }
    }
}

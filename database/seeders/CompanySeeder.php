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
        $users = User::doesntHave('company') -> get() -> shuffle();

        Company::factory()
            -> count($users -> count())
            -> sequence(
                ...$users -> map(fn($user) => ['user_id' => $user->id]) -> toArray()
            )
            -> create();
    }
}

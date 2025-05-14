<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Machine;
use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('/images/articles');
        Storage::makeDirectory('/images/articles');

        $this -> call(UserSeeder::class);

        $this->call(CompanySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(WorkerSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(ColorSeeder::class);

        $this->call(MachineSeeder::class);

        Order::factory(10)->create();
        Cart::factory(7)->create();
        Notification::factory(10)->create();

        $this->call(ArticleSeeder::class);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}

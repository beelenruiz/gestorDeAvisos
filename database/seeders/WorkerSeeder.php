<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workerIds = [3, 4, 5, 6];

        foreach ($workerIds as $id) {
            Worker::create([
                'user_id' => $id,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            Task::create([
                'title' => $faker->sentence(4),
                'description' => $faker->paragraph(),
                'status' => $faker->randomElement(['pending', 'in_progress', 'done']),
                'due_date' => $faker->dateTimeBetween('now', '+1 month'),
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
            ]);
        }
    }
}

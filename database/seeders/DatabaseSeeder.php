<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Assignment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();
        $tasks = \App\Models\Task::factory(20)->create();

        foreach ($users as $user) {
            $taskIds = $tasks->pluck("id")->random(5);
            foreach ($taskIds as $taskId) {
                Assignment::create([
                    'user_id' => $user->id,
                    'task_id' => $taskId,
                ]);
            }
        }
    }
}

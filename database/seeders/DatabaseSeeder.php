<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)
            ->create()
            ->each(function ($user) {

                $projects = $user->projects()
                    ->createMany(
                        \App\Models\Project::factory(5)
                            ->make()
                            ->toArray()
                    );

                foreach ($projects as $project) {

                    $project->tasks()
                        ->createMany(
                            \App\Models\Task::factory(20)
                                ->make()
                                ->toArray()
                        );
                }
            });
    }
}

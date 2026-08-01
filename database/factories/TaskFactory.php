<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'project_id' => Project::factory(),

            'title' => fake()->sentence(),

            'description' => fake()->paragraph(),

            'priority' => fake()->randomElement([
                TaskPriority::LOW,
                TaskPriority::MEDIUM,
                TaskPriority::HIGH,
            ]),

            'status' => fake()->randomElement([
                TaskStatus::TODO,
                TaskStatus::IN_PROGRESS,
                TaskStatus::DONE,
            ]),

            'due_date' => fake()->dateTimeBetween('-5 days', '+20 days'),

        ];
    }
}

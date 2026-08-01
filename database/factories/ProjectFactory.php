<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ProjectStatus;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'user_id' => User::factory(),

            'name' => fake()->sentence(3),

            'description' => fake()->paragraph(),

            'status' => fake()->randomElement([
                ProjectStatus::ACTIVE,
                ProjectStatus::COMPLETED,
                ProjectStatus::ARCHIVED,
            ]),

        ];
    }
}

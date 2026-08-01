<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_filter_tasks()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $project = Project::factory()->create([

            'user_id'=>$user->id

        ]);

        Task::factory()->count(5)->create([

            'project_id'=>$project->id,

            'status'=>'done'

        ]);

        $response = $this->getJson('/api/tasks?status=done');

        $response->assertOk();
    }
}

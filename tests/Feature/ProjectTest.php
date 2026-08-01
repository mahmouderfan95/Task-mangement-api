<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_create_project()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/projects',[

            'name'=>'Laravel',

            'description'=>'API',

            'status'=>'active'

        ]);

        $response->assertCreated();
    }
    public function test_user_can_list_projects()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Project::factory(5)->create([

            'user_id'=>$user->id

        ]);

        $response = $this->getJson('/api/projects');

        $response->assertOk();
    }
}

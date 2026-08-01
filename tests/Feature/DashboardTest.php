<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_dashboard_returns_statistics()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/dashboard');

        $response->assertOk();

        $response->assertJsonStructure([

            'success',

            'message',

            'data'=>[

                'total_projects',

                'active_projects',

                'total_tasks',

                'completed_tasks',

                'pending_tasks',

                'overdue_tasks'

            ]

        ]);
    }
}

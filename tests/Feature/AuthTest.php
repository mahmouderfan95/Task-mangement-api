<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [

            'name'=>'Ahmed',

            'email'=>'ahmed@test.com',

            'password'=>'password',

            'password_confirmation'=>'password'

        ]);

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'message',
                'token',
                'user'
            ]);
    }
    public function test_user_can_login()
    {
        $user = User::factory()->create([

            'password'=>bcrypt('password')

        ]);

        $response = $this->postJson('/api/login',[

            'email'=>$user->email,

            'password'=>'password'

        ]);

        $response->assertOk();
    }
}

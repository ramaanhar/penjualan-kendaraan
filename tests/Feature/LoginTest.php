<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    

    protected function existingUser() {
        return User::factory()->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_wrong_username()
    {
        $response = $this->post('/api/login', ["username" => "wrong_username", "password" => 'password']);
        $response->assertStatus(422);
        $response->assertJson(["message" => "Wrong username/password"]);
    }
    public function test_wrong_password()
    {
        $response = $this->post('/api/login', ["username" => $this->existingUser()['username'], "password" => 'wrong_password']);
        $response->assertStatus(422);
        $response->assertJson(["message" => "Wrong username/password"]);
    }
    public function test_return_token_and_user_data_if_success()
    {
        $response = $this->post('/api/login', ["username" => $this->existingUser()['username'], "password" => "password"]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token', 'user']]);
    }
}

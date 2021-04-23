<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTest extends TestCase
{

    public function testCreation()
    {

        $name = $this->faker->name();
        $email = $this->faker->email();
        $response = $this->postJson('/api/v1/auth/signup', [
            'name' => $name,
            'email' => $email,
            'password' => $this->password,
            'password_confirmation' => $this->password,
            "regulation_accepted" => true
        ]);


        $response
            ->assertStatus(201)
            ->assertExactJson([
                'message' => "Successfully created user!",
            ]);

    }

    public function testLogin()
    {

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $this->email,
            'password' => 'test',
            "remember_me" => 1
        ]);
        $response->assertStatus(200);


    }

    public function testUserInfo()
    {
        $token = $this->createToken();
        $response = $this->getJson('/api/v1/auth/user', ['Authorization' => 'Bearer ' . $token])
            ->assertStatus(200);
    }

    public function testLogout()
    {
        $token = $this->createToken();
        $response = $this->getJson('/api/v1/auth/logout', ['Authorization' => 'Bearer ' . $token])
            ->assertStatus(200);
    }
}

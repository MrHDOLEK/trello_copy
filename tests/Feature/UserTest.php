<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

class UserTest extends TestCase
{

    use WithFaker;

    private string $password = "mypassword";

    public function testUserCreation()
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

    }//testUserCreation

    public function testUserLogin()
    {

        $email = 'test@test.pl';
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $email,
            'password' => 'test',
            "remember_me" => 1
        ]);
        $response->assertStatus(200);


    }

}

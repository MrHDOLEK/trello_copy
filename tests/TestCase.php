<?php

namespace Tests;

use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\UserTest;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    protected string $password = "test";
    protected string $email = 'test@test.pl';

    protected function createToken(): string
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $this->email,
            'password' => 'test',
            "remember_me" => 1
        ]);
        return (string)$response['access_token'];
    }
}

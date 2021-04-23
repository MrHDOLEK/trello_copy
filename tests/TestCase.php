<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createToken() : string
    {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $token = $user->generateToken();
        return (string) $token;
    }
}

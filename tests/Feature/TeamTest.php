<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCheckTeams()
    {
        $token = $this->createToken();
        $response = $this->getJson('api/v1/manage/teams', [
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(401);
    }
}

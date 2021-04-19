<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function publicTable()
    {
        $response = $this->get('api/v1/manage/tables/public');
        $response->assertStatus(200);
    }
    public function createTableWithoutLogin()
    {
        $response = $this->postJson('api/v1/manage/tables', [
            'name' => $this->faker->name,
        ]);
        $response->assertStatus(400);
    }
    public function createPrivateLogin()
    {
        $response = $this->postJson('api/v1/manage/tables', [
            'name' => $this->faker->name,
        ]);
        $response->assertStatus(400);
    }
}

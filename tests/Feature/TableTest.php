<?php

namespace Tests\Feature;

use App\Models\Table;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class TableTest extends TestCase
{
    /** @test */
    public function testPublicTable()
    {
        $response = $this->get('api/v1/manage/tables/public');
        $response->assertStatus(200);
    }
    public function testCreateTableWithoutLogin()
    {
        $response = $this->postJson('api/v1/manage/tables', [
            'name' => $this->faker->name(),
        ]);
        $response->assertStatus(401);
    }
    public function testCreateTableAfterLogin()
    {
        $token = $this->createToken();
        $response = $this->postJson('api/v1/manage/tables', [
            'name' => $this->faker->name(),
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateTableWithoutLogin()
    {
        $table = Table::latest('id')->first();
        $response = $this->putJson('/api/v1/manage/tables?id='.$table['id'], [
            'name' => $this->faker->name(),
            "is_visible" => 0
        ]);
        $response->assertStatus(401);
    }
    public function testUpdateTableAfterLogin()
    {
        $token = $this->createToken();
        $table = Table::latest('id')->first();
        $response = $this->putJson('/api/v1/manage/tables?id='.$table['id'], [
            'name' => $this->faker->name(),
            "is_visible" => 0
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(200);
    }

}

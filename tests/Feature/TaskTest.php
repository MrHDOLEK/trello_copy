<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateTaskInCard()
    {
        $token = $this->createToken();
        $table = Table::latest('id')->first();
        $card = Card::where('table_id',$table['id'])->latest('id')->first();
        $response = $this->postJson('/api/v1/manage/tasks?id='.$card['id'], [
            'task_name' => $this->faker->name(),
            'task_content' => $this->faker->regexify('[A-Za-z0-9]{20}')
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateTaskInCard()
    {
        $token = $this->createToken();
        $table = Table::latest('id')->first();
        $card = Card::where('table_id',$table['id'])->latest('id')->first();
        $response = $this->putJson('/api/v1/manage/tasks?id='.$card['id'], [
            'task_name' => $this->faker->name(),
            'task_content' => $this->faker->regexify('[A-Za-z0-9]{20}')
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(422);
    }
    public function testDeleteTaskInCard()
    {
        $token = $this->createToken();
        $table = Table::latest('id')->first();
        $card = Card::where('table_id',$table['id'])->latest('id')->first();
        $response = $this->deleteJson('/api/v1/manage/tasks?id='.$card['id'], [
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(500);
    }
}

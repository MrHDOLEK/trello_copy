<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCardInTable()
    {
        $token = $this->createToken();
        $table = Table::get('id')->first();
        $response = $this->postJson('/api/v1/manage/cards?id='.$table['id'], [
            'card_name' => $this->faker->name(),
            'card_content' => $this->faker->regexify('[A-Za-z0-9]{20}')
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateCardInTable()
    {
        $token = $this->createToken();
        $table = Table::get('id')->first();
        $card = Card::where('table_id',$table['id'])->latest('id')->first();
        $response = $this->putJson('/api/v1/manage/cards?id='.$card['id'], [
            'card_name' => $this->faker->name(),
            'card_content' => $this->faker->regexify('[A-Za-z0-9]{20}')
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(200);
    }
    public function testDeleteCardInTable()
    {
        $token = $this->createToken();
        $table = Table::get('id')->first();
        $card = Card::where('table_id',$table['id'])->get('id')->first();
        $response = $this->deleteJson('/api/v1/manage/cards?id='.$card['id'], [
        ],[
            'Authorization' => 'Bearer '.$token
        ]);
        $response->assertStatus(200);
    }
}

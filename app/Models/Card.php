<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'card_name', 'card_content', 'card_type','table_id'
    ];

    protected $hidden = [
        'id', 'table_id', 'created_at', 'updated_at', 'pivot'
    ];

    public function table()
    {
        return $this->hasOne(Table::class, 'id', 'table_id');
    }

    public function task()
    {
        return $this->belongsToMany(Task::class, 'task_card', 'task_id', 'card_id');
    }
    public function new(int $id,string $card_name,string $card_content,int $user_id)
    {
        $creator_id =  Card::with('table')->get()->pluck('table.creator_id');
        if(!($creator_id[0] == $user_id))
        {
            return null;
        }

         $card = Card::create([
            'card_name' =>  $card_name,
            'card_content' => json_encode($card_content),
            'card_type' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'table_id' => $id,
        ]);
        DB::table('card_table')->insert([
            'card_id' => $card->id,
            'table_id' => $id
        ]);
        return true;
    }
}

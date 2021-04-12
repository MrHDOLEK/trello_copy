<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $guarded = [
        'id'
    ];
    //zabezpieczenie table+id
    protected $fillable = [
        'card_name', 'card_content', 'card_type', 'updated_at','table_id'
    ];

    protected $hidden = [
        'created_at', 'pivot'
    ];

    public function table()
    {
        return $this->hasOne(Table::class, 'id', 'table_id');
    }

    public function task()
    {
        return $this->belongsToMany(Task::class, 'task_card', 'task_id', 'card_id');
    }

    public function createCard(int $id, string $card_name, string $card_content, int $user_id)
    {
        $creator_id = Table::where('id',$id)->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }


        $card = Card::create([
            'card_name' => $card_name,
            'card_content' => json_encode($card_content),
            'card_type' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'table_id' => $id,
        ]);
        ///Do poprawy można to w pełni zrobić na orm czyt wykorzystac sync i podczas dodania automatycznie wpisy sie do pivota wstawią
        DB::table('card_table')->insert([
            'card_id' => $card->id,
            'table_id' => $id
        ]);
        return true;
    }

    public function updateCard(int $id, string $card_name, string $card_content, int $user_id)
    {
        $table_id = Card::find($id)->get('table_id');
        $creator_id = Table::where('id',$table_id[0]['table_id'])->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        Card::find($id)->update([
            'card_name' => $card_name,
            'card_content' => json_encode($card_content),
            'card_type' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        return true;
    }

    public function deleteCard(int $id, int $user_id)
    {
        $table_id = Card::find($id)->get('table_id');
        $creator_id = Table::where('id',$table_id[0]['table_id'])->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        //Do poprawy można to w pełni zrobić na orm
        DB::table('card_table')->where('card_id', $id)->delete();
        DB::table('task_card')->where('card_id', $id)->delete();
        Card::task()->delete();
        Card::find($id)->delete();
        return true;
    }

}

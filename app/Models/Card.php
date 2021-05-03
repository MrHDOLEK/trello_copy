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
    protected $guarded = [
        'id'
    ];
    //zabezpieczenie table+id
    protected $fillable = [
        'card_name', 'card_content', 'card_type', 'updated_at', 'table_id'
    ];

    protected $hidden = [
        'created_at', 'pivot'
    ];
    protected $casts = [
        'card_content' => 'object'
    ];

    public function table()
    {
        return $this->hasOne(Table::class, 'id', 'table_id');
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function createCard(int $id, string $card_name, string $card_content, int $user_id)
    {


        $creator_id = Table::where('id', $id)->where('creator_id', $user_id)->first();
        $team = new Team();
        try {
            if ($team->checkExistUserInTeam($id, $user_id)) {

            } else if (!($creator_id->creator_id == $user_id)) {
                return null;
            }
        } catch (\Exception $e) {
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
        return $card;
    }

    public function updateCard(int $id, string $card_name, string $card_content, int $user_id)
    {
        $card = Card::where('id', $id)->firstOrFail();
        self::checkPermission($user_id, $card);
        Card::find($id)->update([
            'card_name' => $card_name,
            'card_content' => json_encode($card_content),
            'card_type' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        return true;
    }

    public function deleteCard(int $id, int $user_id)
    {
        $card = Card::where('id', $id)->firstOrFail();
        self::checkPermission($user_id, $card);
        Card::task()->delete();
        Card::find($id)->delete();
        return true;
    }

    private function checkPermission(int $user_id, Card $card = null, $table_id = null,)
    {
        if (!($card == null)) {
            $table_id = $card->table_id;
        }
        $creator_id = Table::where('id', $table_id)->first();
        $team = new Team();
        try {
            if ($team->checkExistUserInTeam($table_id, $user_id)) {

            } else if (!($creator_id->creator_id == $user_id)) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }


}

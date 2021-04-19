<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    private int $visible_public = 1;
    private int $visible_private = 0;

    protected $guarded = ['id'];
    protected $fillable = [
        'users', 'name', 'creator_id', 'theme_id', 'is_visible', 'team_id'
    ];
    protected $hidden = [
        'pivot'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');

    }

    public function theme()
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id');
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function card()
    {
        return $this->hasMany(Card::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function getPublicTable()
    {
        $result = Table::where('is_visible', $this->visible_public)
            ->paginate(20);
        return $result;
    }

    public function getPrivateTable(int $user_id)
    {
        $result = Table::where('creator_id', $user_id)
            ->get();
        return $result;
    }

    public function getPublicContent(int $id_table)
    {
        $content = Table::with('card.task')->find($id_table);

        if (!$content->is_visible == 0) {
            return $content;
        }
        return null;
    }

    public function getPrivateContent(int $id_table, int $user_id)
    {
        $content = Table::with('card.task')->find($id_table);
        $team = new Team();
        if ($content->creator_id == $user_id) {
            return $content;
        }
        if ($team->checkExistUserInTeam($id_table, $user_id)) {
            return $content;
        }
        return null;


    }

    public function createTable(string $name, string $name_user, int $creator_id)
    {
        try {
            $table = Table::create([
                'users' => json_encode([$name_user]),
                'name' => $name,
                'is_visible' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'creator_id' => $creator_id,
                'theme_id' => 1,
            ]);
            $card = Card::create([
                'card_name' => 'To do',
                'card_content' => json_encode('To do:'),
                'card_type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'table_id' => $table->id
            ]);
            DB::table('card_table')->insert([
                'card_id' => $card->id,
                'table_id' => $table->id
            ]);
            $task = Task::create([
                'task_name' => 'Fix car',
                'task_content' => json_encode('Broken battery'),
                'task_type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'card_id' => $card->id,
            ]);
            DB::table('task_card')->insert([
                'card_id' => $card->id,
                'task_id' => $task->id
            ]);

            $card = Card::create([
                'card_name' => 'Doing - now',
                'card_content' => json_encode('Doing - now:'),
                'card_type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'table_id' => $table->id
            ]);
            DB::table('card_table')->insert([
                'card_id' => $card->id,
                'table_id' => $table->id
            ]);
            $task = Task::create([
                'task_name' => 'Wash the dog',
                'task_content' => json_encode('Wash the dog'),
                'task_type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'card_id' => $card->id,
            ]);
            DB::table('task_card')->insert([
                'card_id' => $card->id,
                'task_id' => $task->id
            ]);

            $card = Card::create([
                'card_name' => 'Done',
                'card_content' => json_encode('Done'),
                'card_type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'table_id' => $table->id
            ]);
            DB::table('card_table')->insert([
                'card_id' => $card->id,
                'table_id' => $table->id
            ]);
            $task = Task::create([
                'task_name' => 'Make dinner',
                'task_content' => json_encode('spaghetti and soup'),
                'task_type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'card_id' => $card->id,
            ]);
            DB::table('task_card')->insert([
                'card_id' => $card->id,
                'task_id' => $task->id
            ]);

            return true;
        } catch (Execution $e) {
            return null;
        }
    }

    public function updateTable(int $id, int $is_visible, string $table_name, int $user_id, int $team_id = null)
    {
        $creator_id = Table::where('id', $id)->where('creator_id', $user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        Table::find($id)->update([
            'name' => $table_name,
            'is_visible' => $is_visible,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'theme_id' => 1,
            'team_id' => $team_id
        ]);

        return true;
    }

    public function deleteTable(int $id, int $user_id)
    {
        $creator_id = Table::where('id', $id)->where('creator_id', $user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        Table::find($id)->delete();
        return true;
    }
}

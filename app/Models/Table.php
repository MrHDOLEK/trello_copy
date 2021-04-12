<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'users', 'name', 'creator_id', 'theme_id', 'is_visible'
    ];
    protected $hidden = [
        'team_id', 'pivot'
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
        $result = Table::where('isVisible', $this->visible_public)
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
        return Table::with('card.task')
            ->where('creator_id', $user_id)
            ->find($id_table)
            ->firstOrFail();
    }

    public function createTable(string $name, string $name_user, int $creator_id)
    {
        return $table = Table::create([
            'users' => json_encode([$name_user]),
            'name' => $name,
            'is_visible' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'creator_id' => $creator_id,
            'theme_id' => 1,
        ]);
    }

    public function updateTable(int $id, int $is_visible, string $table_name, int $user_id)
    {
        $creator_id = Table::where('id',$id)->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        Table::find($id)->update([
            'name' => $table_name,
            'is_visible' => $is_visible,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'creator_id' => $user_id,
            'theme_id' => 1,
        ]);

        return true;
    }

    public function deleteTable(int $id, int $user_id)
    {
        $creator_id = Table::where('id',$id)->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        Table::find($id)->delete();
        return true;
    }
}

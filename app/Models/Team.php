<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name', 'admin', 'users'
    ];

    public function table()
    {
        return $this->belongsToMany(Table::class);
    }

    public function show(int $user_id)
    {
        $user = Table::where('id', $user_id)->firstOrFail();
        return Team::where('id', $user->team_id)->firstOrFail();
    }

    public function createTeam(string $team_name, array $users_mail, string $user_name)
    {
        try {
            Team::create([
                'name' => $team_name,
                'admin' => $user_name,
                'users' => json_encode(self::changeMailToId($users_mail)),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }
    public function updateTeam(int $id_table,string $team_name = null, array $users_mail = null)
    {
        try {
            Team::update([
                'users' => json_encode(self::changeMailToId($users_mail)),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }
    public function deleteTeam(int $id_user, int $id_table)
    {
        try {
            $table = Table::where('id', $id_table)->where('creator_id', $id_user)->firstOrFail();
            Table::where('id', $id_table)->where('creator_id', $id_user)->update([
                'team_id' => null
            ]);
            Team::find($table->team_id)->delete();
            return true;
        } catch (Exception $e) {
            return null;
        }
    }

    //Zainplementować to jako interfejs
    private function changeMailToId(array $users_mail): array
    {
        $users_id = [];
        foreach ($users_mail as $mail) {
            $user = User::where('email', $mail)->firstOrFail();
            if (!($user == null) || !(empty($user))) {
                array_push($users_id, $user->id);
            }
        }
        return $users_id;

    }
}

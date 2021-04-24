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
        $user = new User();
        if ($user->checkPermission($user_id) == 'admin') {
            $result = Team::get()->paginate(20);
            return $result;
        }
        $user = Table::where('creator_id', $user_id)->firstOrFail();
        return Team::where('id', $user->team_id)->firstOrFail();
    }

    public function createTeam(string $team_name, array $users_mail, int $user_id, int $table_id = null)
    {
        $packet = new Packet();
        $user = User::where('id', $user_id)->firstOrFail('name');
        $limits = $packet->checkLimit($user_id);
        $quantity_teams = Team::where('admin', $user['name'])->count();
        if ($limits['max_teams'] <= $quantity_teams) {
            return null;
        }
        try {
            $user_name = User::find($user_id)->name;
            $team = Team::create([
                'name' => $team_name,
                'admin' => $user_name,
                'users' => json_encode(self::changeMailToId($users_mail)),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (!($table_id === null)) {
                Table::where('id', $table_id)->where('creator_id', $user_id)->update([
                    'team_id' => $team->id
                ]);
            }
            return true;
        } catch (Exception $e) {
            return null;
        }
    }

    public function assignmentTeam(int $id_table, int $id_team, int $user_id)
    {
        try {
            Table::where('id', $id_table)->where('creator_id', $user_id)->update([
                'team_id' => $id_team,
            ]);
            return true;
        } catch (Exception $e) {
            return null;
        }
    }

    public function updateTeam(int $id_table, string $team_name, array $users_mail = null, int $id_user)
    {
        try {
            $users_id = self::getUserId($id_table, $id_user);
            if (!($users_mail == null)) {
                $new_users_id = self::changeMailToId($users_mail);
            } else {
                $new_users_id = [];
            }
            $update_users_id = array_merge($users_id, $new_users_id);
            Table::where('id', $id_table)->team()->update([
                'name' => $team_name,
                'users' => json_encode($update_users_id),
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
    private function getUserId(int $id_table, int $id_user): array
    {
        $table = Table::with('team')->where('id', $id_table)->where('creator_id', $id_user)->firstOrFail();
        return json_decode($table->team->users);

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

    public function checkExistUserInTeam(int $id_table, int $user_id): bool
    {

        $table = Table::with('team')->where('id', $id_table)->firstOrFail();

        if ($table->team == null) {
            return false;
        }
        $users = json_decode($table->team->users);
        if (in_array($user_id, $users)) {
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'task_name','task_content','task_type','card_id','updated_at'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function card() {
        return $this->hasOne(Card::class ,'id','card_id');
    }
    public function createTask(int $id, string $task_name,$task_content, int $user_id)
    {
        $card = Card::where('id',$id)->first();
        $table = $card->table;
        $team = new Team();
        try {
            if ($team->checkExistUserInTeam($table->id, $user_id)) {

            } else if (!($table->creator_id == $user_id)) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }


        $task = Task::create([
            'task_name' => $task_name,
            'task_content' => json_encode($task_content),
            'task_type' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'card_id' => $id,
        ]);
        DB::table('task_card')->insert([
            'card_id' => $id,
            'task_id' => $task->id
        ]);
        return true;
    }
    public function updateTask(int $id, string $task_name, string $task_content, int $user_id)
    {
        $task= Task::where('id',$id)->first();
        $table = $task->card->table;
        $team = new Team();
        try {
            if ($team->checkExistUserInTeam($table->id, $user_id)) {

            } else if (!($table->creator_id == $user_id)) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
        Task::find($id)->update([
            'task_name' => $task_name,
            'task_content' => $task_content,
            'task_type' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        return true;
    }
    public function deleteTask(int $id, int $user_id)
    {
        $task= Task::where('id',$id)->first();
        $table = $task->card->table;
        $team = new Team();
        try {
            if ($team->checkExistUserInTeam($table->id, $user_id)) {

            } else if (!($table->creator_id == $user_id)) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
        Task::find($id)->delete();

        return true;
    }
}

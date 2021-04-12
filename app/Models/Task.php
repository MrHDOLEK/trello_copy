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
    public function getAssignedTask(int $id_card)
    {
        return Task::get();
    }
    public function createTask(int $id, string $task_name, string $task_content, int $user_id)
    {
        $creator_id = Table::with('card.task')->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
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
        $creator_id = Table::with('card.task')->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        Task::find($id)->update([
            'task_name' => $task_name,
            'task_content' => json_encode($task_content),
            'task_type' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        return true;
    }
    public function deleteTask(int $id, int $user_id)
    {
        $table_id = Card::find($id)->get('table_id');
        $creator_id = Table::where('id',$table_id[0]['table_id'])->where('creator_id',$user_id)->firstOrFail();
        if (!($creator_id->creator_id == $user_id)) {
            return null;
        }
        //Do poprawy można to w pełni zrobić na orm
        DB::table('task_card')->where('task_id', $id)->delete();
        Task::find($id)->delete();

        return true;
    }
}

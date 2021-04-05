<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'task_name','task_content','task_type'
    ];

    protected $hidden = [
        'id','card_id'
    ];

    public function card() {
        return $this->hasOne(Card::class ,'id','card_id');
    }
    public function getAssignedTask(int $id_card)
    {
        return Task::get();
    }
}

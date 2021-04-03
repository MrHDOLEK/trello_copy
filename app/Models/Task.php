<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'taks';

    protected $fillable = [
        'task_name','task_content','task_type'
    ];

    protected $hidden = [
        'card_id'
    ];

    public function card() {
        return $this->hasOne(Card::class);
    }
}

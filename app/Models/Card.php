<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function table() {
        return $this->hasOne(Table::class);
    }

    public function task() {
        return $this->belongsToMany(Task::class);
    }
}

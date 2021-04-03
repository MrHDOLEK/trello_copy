<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'card_name','card_content','card_type'
    ];

    protected $hidden = [
        'table_id'
    ];

    public function table() {
        return $this->hasOne(Table::class);
    }

    public function task() {
        return $this->belongsToMany(Task::class);
    }
}

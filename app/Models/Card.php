<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'card_name', 'card_content','card_type'
    ];

    protected $hidden = [
        'id', 'table_id','created_at','updated_at'
    ];

    public function table()
    {
        return $this->hasOne(Table::class,'id','table_id');
    }

    public function task()
    {
        return $this->belongsToMany(Task::class,'task_card' , 'task_id' , 'card_id');
    }
}

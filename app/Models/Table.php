<?php

namespace App\Models;

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

    protected $fillable = [
        'users','name','id','creator_id'
    ];
    protected $hidden = [
       'is_visible','theme_id', 'team_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','creator_id');

    }

    public function theme()
    {
        return $this->hasOne(Theme::class,'id','theme_id');
    }

    public function team()
    {
        return $this->hasOne(Team::class,'id','team_id');
    }

     public function card()
    {
        return $this->belongsToMany(Card::class,'card_table' , 'card_id' , 'table_id');
    }

    public function task()
    {
        return $this->belongsToMany(Task::class,'task_card' , 'task_id' , 'card_id');
    }

    public function getPublic()
    {
        $result = Table::where('isVisible', '=', $this->visible_public)
            ->paginate(20);
        return $result;
    }

    public function getPrivate()
    {

    }
    public function getCards(int $id_table)
    {
       // return Table::card();
        //return Card::where('table_id',$id_table)
          //  ->task()
          //  ->get();

        //$card = Card::where('table_id',$id_table)->get();
       // dd($card->id);
       // return Task::get();
    /*Todo:
       Odzysk po id danej tabeli calego contentu czyt taski,cardy*/
        return Table::first()->card()->task()->get();

    }
}

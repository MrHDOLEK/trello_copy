<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    private int $visible_public = 1;
    private int $visible_private = 0;

    protected $fillable = [
        'users', 'name', 'is_visible', 'theme_id', 'creator_id', 'team_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function theme()
    {
        return $this->hasOne(Theme::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function card()
    {
        return $this->belongsToMany(Card::class);
    }

    public function getPublic()
    {
        $table = Table::where('isVisible', '=', $this->visible_public)
            ->paginate(15);
        dd($table);
    }

    public function getPrivate()
    {

    }
}

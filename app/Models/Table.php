<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'name','users','is_visible'
    ];

    protected $hidden = [
        'theme_id','creator_id','team_id'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function theme() {
        return $this->hasOne(Theme::class);
    }

    public function team() {
        return $this->hasOne(Team::class);
    }

    public function card() {
        return $this->belongsToMany(Card::class);
    }
}

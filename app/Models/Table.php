<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

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

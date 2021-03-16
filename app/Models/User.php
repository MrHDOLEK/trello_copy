<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function session() {
        return $this->belongsTo(Session::class);
    }

    public function personalData() {
        return $this->belongsTo(UserPersonalData::class);
    }

    public function userPermission() {
        return $this->belongsTo(UserPermission::class);
    }

    public function tables() {
        return $this->belongsToMany(Table::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalData extends Model
{
    use HasFactory;

    protected $table = 'users_personal_data';

    protected $fillable = [
        'avatar','user_id','regulation_accepted','address'
    ];


    public function user() {
        return $this->hasOne(User::class);
    }
}

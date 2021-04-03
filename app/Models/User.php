<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function personalData()
    {
        return $this->belongsTo(UserPersonalData::class);
    }

    public function userPermission()
    {
        return $this->belongsTo(UserPermission::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function checkExists(string $name, string $email): bool
    {
        $users = User::where('email', '=', $email)
            ->where('name', '=' , $name)
            ->first();
        if(!($users === null))
        {
            return true;
        }
        return false;
    }
    public function checkPermission(User $user)
    {
        $permission_id = UserPermission::where('user_id','=',$user->id)
            ->first();
        $permission_id =  $permission_id->attributes['permission_id'];
        $permission_name = Permission::where('id','=',$permission_id)
            ->first();
        return $permission_name;
    }
}

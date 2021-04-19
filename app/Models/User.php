<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    private $permission_user = 0;
    private $permission_admin = 1;
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
        return $this->hasOne(UserPermission::class, 'user_id', 'id');
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
    public function checkPermission(int $user_id): string
    {
        $permisssion = User::with('userPermission.permission')->find($user_id);
        return $permisssion->userPermission->permission->name;
    }
}

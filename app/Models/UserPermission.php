<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $table = 'users_permissions';
    protected $fillable = [
        'users_permissions', 'users_permissions', 'user_id'
    ];
    protected $hidden = [
        'permission_id'
    ];
    public function user() {
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function permission() {
        return $this->hasOne(Permission::class,'id', 'permission_id');
    }
}

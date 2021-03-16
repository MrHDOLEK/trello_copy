<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }

    public function permission() {
        return $this->hasOne(Permission::class);
    }
}

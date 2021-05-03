<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    private $permission_user = 0;
    private $permission_admin = 1;
    use  HasFactory, Notifiable, HasApiTokens;

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

    public function generateToken()
    {
        return $this->createToken('my-oauth-client-name')->accessToken;
    }

    public function checkExists(string $name, string $email): bool
    {
        $users = User::where('email', '=', $email)
            ->where('name', '=', $name)
            ->first();
        if (!($users === null)) {
            return true;
        }
        return false;
    }

    public function checkPermission(int $user_id): string
    {
        if($user_id === null)
        {
            return "";
        }
        $permisssion = User::with('userPermission.permission')->find($user_id);
        return $permisssion->userPermission->permission->name;
    }

    public function getUsers($validated) {
        if(!empty($validated))
            return User::findOrFail($validated['user_id']);

        return User::all();
    }

    public function getUserDetails($validated) {
        $details = [
            'personal_data' => UserPersonalData::where('user_id', $validated['user_id'])->first(),
            'permission' => UserPermission::where('user_id', $validated['user_id'])->first()
        ];

        return $details;
    }

    public function updateUser($validated) {
        $user = User::firstWhere('id', $validated['user_id']);
        $user->update($validated);
    }

    public function deleteUser($validated) {
        $user = User::firstWhere('id', $validated['user_id'])->first();
        $user->delete();
    }

    public function isAdmin() {
        $user_permission = $this->with('userPermission.permission')
            ->find($this->id)
            ->userPermission
            ->permission
            ->name;

        if($user_permission === "admin")
            return true;
        else
            return false;
    }
}

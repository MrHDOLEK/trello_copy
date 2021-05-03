<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Boolean;

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

//    public function createUserPersonalData($data) {
//        UserPersonalData::create($data);
//    }

    public function postAvatar($path, $avatar, $name) {
        Storage::disk('public')->putFileAs($path, $avatar, $name);
    }

    /**
     * @throws Exception
     */
    public function getAvatar($user_id): String {
        $avatar = 'avatars/' . $user_id . '/avatar.jpg';
        $default_avatar = 'avatars/default/' . random_int(1,30) . '.png';

        if(Storage::disk('public')->exists($avatar))
            return Storage::disk('public')->url($avatar);
        else
            return Storage::disk('public')->url($default_avatar);
    }

    public function deleteAvatar($user_id) {
        $path = 'avatars/' . $user_id;
        Storage::disk('public')->deleteDirectory($path);
    }

    public function getAddress($user_id) {
        return UserPersonalData::where('user_id', $user_id)->get('address');
    }

    public function updateAddress($user_id, $validated) {
        UserPersonalData::where('user_id', $user_id)->update([
            'address' => $validated['address']
        ]);
    }

    public function deleteAddress($user_id) {
        UserPersonalData::where('user_id', $user_id)->update([
            'address' => null
        ]);
    }

    public function isRegulationAccepted($user_id): Boolean {
        return UserPersonalData::where('user_id', $user_id)->get('regulation_accepted');
    }

    public function setRegulationAcceptance($user_id, $validated) {
        UserPersonalData::where('user_id', $user_id)->update([
            'regulation_accepted' => $validated['regulation_acceptance']
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPersonalData;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserPersonalDataController extends Controller
{
    public function postAvatar(Request $request) {
        $path = 'avatars/' . $request->user()->id;
        $avatar = ($request->file('image'));
        $name = 'avatar.' . $avatar->extension();

        if(!($avatar->extension() === 'jpg'))
            return response(['message' => 'Bad extension.'], 404);

        if(!$avatar->isValid())
            return response(['message' => 'Cannot upload file.'], 404);

        Storage::disk('public')->putFileAs($path, $avatar, $name);

        return response([
            'message' => 'Success!',
        ]);
    }

    public function getAvatar(Request $request) {
        $path = 'avatars/' . $request->user()->id;

        return Storage::disk('public')->get($path . '/avatar.jpg');
    }

    public function deleteAvatar(Request $request) {
        $path = 'avatars/' . $request->user()->id;
        Storage::disk('public')->deleteDirectory($path);

        return response([
            'message' => 'Success! Avatar deleted!'
        ]);
    }

    public function getAddress(Request $request) {
        $address = UserPersonalData::where('user_id', $request->user()->id)->get('address');

        return response([
            'address' => $address
        ]);
    }

    public function updateAddress(Request $request) {
        UserPersonalData::where('user_id', $request->user()->id)->update(['address' => $request->address]);

        return response([
            'message' => 'Success! Address updated!'
        ]);
    }

    public function deleteAddress(Request $request) {
        UserPersonalData::where('user_id', $request->user()->id)->update(['address' => null]);

        return response([
            'message' => 'Success! Address deleted!'
        ]);
    }

    public function isRegulationAccepted(Request $request) {
        $regulation_accepted = UserPersonalData::where('user_id', $request->user()->id)->get('regulation_accepted');

        return response([
            'regulation_accepted' => $regulation_accepted
        ]);
    }

    public function setRegulationAcceptance(Request $request) {
        UserPersonalData::where('user_id', $request->user()->id)->update(['regulation_accepted' => $request->regulation_accepted]);

        return response([
            'message' => 'Succes! Regulation set as accepted!'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UserPersonalData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserPersonalDataController extends Controller
{
    public function uploadAvatar(Request $request): Response {
        $path = 'avatars/' . $request->user()->id;
        $avatar = $request->file('image');
        $name = 'avatar.' . $avatar->extension();

        if(!($avatar->extension() === 'jpg'))
            return response(
                'Bad extension.',
                400
            );

        if(!$avatar->isValid())
            return response(
                'Cannot upload file.',
                400
            );

        $user_personal_data = new UserPersonalData();
        $user_personal_data->postAvatar($path, $avatar, $name);

        return response(
            'Success! Avatar has been uploaded!',
            200
        );
    }

    public function retrieveAvatar(Request $request): Response {
        $user_personal_data = new UserPersonalData();
        $url = $user_personal_data->getAvatar($request->user()->id);

        return response(
            $url,
            200
        );
    }

    public function deleteAvatar(Request $request): Response {
        $user_personal_data = new UserPersonalData();
        $user_personal_data->deleteAvatar($request->user()->id);

        return response(
            'Success! Avatar has been deleted!',
            200
        );
    }

    public function getAddress(Request $request): Response {
        $user_personal_data = new UserPersonalData();
        $address = $user_personal_data->getAddress($request->user()->id);

        return response(
            $address,
            200
        );
    }

    public function updateAddress(Request $request): Response {
        $validated = $request->validate([
            'address' => 'string|max:255'
        ]);

        $user_personal_data = new UserPersonalData();
        $user_personal_data->updateAddress($request->user()->id, $validated);

        return response(
            'Success! Address has been updated!',
            200
        );
    }

    public function deleteAddress(Request $request): Response {
        $user_personal_data = new UserPersonalData();
        $user_personal_data->deleteAddress($request->user()->id);

        return response(
            'Success! Address deleted!',
            200
        );
    }

    public function isRegulationAccepted(Request $request): Response {
        $user_personal_data = new UserPersonalData();
        $is_accepted = $user_personal_data->isRegulationAccepted($request->user()->id);

        return response(
            $is_accepted,
            200
        );
    }

    public function setRegulationAcceptance(Request $request): Response {
        $validated = $request->validate([
            'regulation_acceptance' => 'required|boolean'
        ]);

        $user_personal_data = new UserPersonalData();
        $user_personal_data->setRegulationAcceptance($request->user()->id, $validated);

        return response(
            'Success! Regulation set as accepted!',
            200
        );
    }
}

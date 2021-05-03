<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserPersonalData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class ManageUsersController extends Controller
{
    public function create(Request $request): Response {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'address' => 'string|max:255',
            'regulation_accepted' => 'required|boolean'
        ]);

        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);
        $user->save();

        $user_personal_data = new UserPersonalData([
            'address' => $validated['address'],
            'regulation_accepted' => $validated['regulation_accepted'],
            'user_id' => $user->id,    //HOW TO GET ID!! PROBLEM!!!
        ]);
        $user_personal_data->save();

        $user_permission = new UserPermission([
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => $user->id,
        ]);
        $user_permission->save();

        return response(
            'User has been created!',
            200
        );
    }

    public function get(Request $request): Response {
        $user = new User();
        $data = $user->getUsers($request->validate([
            'user_id' => 'integer|max:255'
        ]));

        return response(
            $data,
            200
        );
    }

    public function getDetails(Request $request): array {
        $user = new User();
        $details = $user->getUserDetails($request->validate([
            'user_id' => 'required|integer|max:255'
        ]));

        return $details;
    }

    public function update(Request $request): Response {
        $user = new User();
        $user->updateUser($request->validate([
            'user_id' => 'required|integer|max:255',
            'name' => 'string',
            'email' => 'string|email|unique:users',
            'password' => 'string|confirmed'
        ]));

        return response(
            'Success! User has been updated!',
            200
        );
    }

    public function delete(Request $request): Response {
        $user = new User();
        $user->deleteUser($request->validate([
            'user_id' => 'required|integer|max:255'
        ]));

        return response(
            'Success! User has been deleted!',
            200
        );
   }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserPersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ManageUsersController extends Controller
{
    public function createUser(Request $request) {
        $user = new User([
            'name' => (string)$request->name,
            'email' => (string)$request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user->checkExists($user->name, $user->email)) {
            return response([
                'message' => 'User with given e-mail and name exists',
                200
            ]);
        }
        $user->save();

        $user_personal_data = new UserPersonalData([
            'address' => (string)$request->address,
            'regulation_accepted' => (bool)$request->regulation_accepted,
            'user_id' => (integer)$user->id,
        ]);
        $user_personal_data->save();

        $user_permission = new UserPermission([
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_id' => (int)$user->id,
        ]);
        $user_permission->save();

        return response([
            'message' => 'User has been created!',
            200
        ]);
    }

    public function getUsers(Request $request) {
        if(!empty($request->user_id))
            return User::findOrFail($request->user_id);

//        if(!empty($request->user_id)) {
//            $user = User::findOrFail($request->user_id);
//            $user_personal_data = UserPersonalData::where('user_id', $request->user_id)->get();
//            $user_permission = UserPermission::where('user_id', $request->user_id)->get();
//            return response()->json([$user ,$user_personal_data ,$user_permission]);
//        }

        return User::all();
    }

    public function getUserDetails(Request $request) {
        $details = [
            UserPersonalData::where('user_id',$request->user_id),
            UserPermission::where('user_id',$request->user_id)
        ];

        return $details;
    }

    public function updateUser(Request $request) {
        $user = User::findOrFail($request->user_id);
        $user->update($request->all());

        return response([
            'message' => 'Success! User has been updated!',
            200
        ]);
    }

    public function deleteUser(Request $request) {
        $user = User::findOrFail($request->user_id);
        $user->delete();

        return response([
            'message' => 'Success! User has been deleted!',
            200
        ]);
   }
}

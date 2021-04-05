<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMessage;
use App\Models\UserPersonalData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'address' => 'string',
            'regulation_accepted' => 'required|boolean'
        ]);

        $user = new User([
            'name' => (string)$request->name,
            'email' => (string)$request->email,
            'password' => (string)bcrypt($request->password)
        ]);

        if ($user->checkExists($user->name, $user->email)) {
            return response()->json([
                'message' => 'User with given e-mail and name exists'
            ], 200);
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

        Mail::to($user->email)->send(new WelcomeMessage());
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ],200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ],200);
    }
}

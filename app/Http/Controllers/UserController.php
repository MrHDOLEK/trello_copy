<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserPermission;

class UserController extends Controller
{
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function retrieveInfo(Request $request): JsonResponse
    {
        $permission_name = $request->user()->checkPermission($request->user()->id);
        return response()->json(array(
                'user' => $request->user(),
                'permission' => $permission_name
            ),200
        );
    }
}

<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $team = new Team();
        $message = $team->show($request->user()->id);
        if (!empty($message)) {
            return response()->json($message, 200);
        }
        return response()->json(['message' => 'Permission error'], 401);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'users_mail' => 'required|array'
        ]);
        $user_name = $request->user()->name;
        $team = new Team();
        $message = $team->createTeam($request->team_name, $request->users_mail, $user_name);
        if (!empty($message)) {
            return response()->json('Team have been successfully create', 200);
        }
        return response()->json(['message' => 'Create error'], 400);
    }

    public function delete(Request $request): JsonResponse
    {
        return response()->json(['message' => 'No permission to view'], 403);
    }
}

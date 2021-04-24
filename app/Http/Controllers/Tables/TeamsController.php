<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $team = new Team();
        $user = new User();
        $message = $team->show($request->user()->id);
        if (!empty($message)) {
            return response()->json($message, 200);
        }
        return response()->json(['message' => 'Permission error'], 401);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int|max:255',
            'team_name' => 'required|string|max:255',
            'users_mail' => 'required|array'
        ]);
        $user_id = $request->user()->id;
        $team = new Team();
        $message = $team->createTeam($request->team_name, $request->users_mail, $user_id, $request->id);
        if (!empty($message)) {
            return response()->json('Team have been successfully create', 200);
        }
        return response()->json(['message' => 'Create error'], 400);
    }

    public function assignment(Request $request): JsonResponse
    {
        $request->validate([
            'id_team' => 'required|int|max:255',
            'id_table' => 'required|int|max:255',
        ]);
        $team = new Team();
        $user_id = $request->user()->id;
        $message = $team->assignmentTeam($request->id_table,$request->id_team,$user_id);
        if (!empty($message)) {
            return response()->json('User have been successfully assignment for team', 200);
        }
        return response()->json(['message' => 'Assignment error'], 400);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int|max:255',
            'team_name' => 'string|max:255',
            'users_mail' => 'array',
        ]);
        $team = new Team();
        $message = $team->updateTeam($request->id, $request->team_name, $request->users_mail, $request->user()->id);
        if (!empty($message)) {
            return response()->json('Team have been successfully update', 200);
        }
        return response()->json(['message' => 'Update error'], 400);
    }

    public function delete(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|int|max:255'
        ]);
        $id_user = $request->user()->id;
        $team = new Team();
        $message = $team->deleteTeam($id_user, $request->id);
        if (!empty($message)) {
            return response()->json('Team have been successfully delete', 200);
        }
        return response()->json(['message' => 'Delete error'], 400);
    }
}

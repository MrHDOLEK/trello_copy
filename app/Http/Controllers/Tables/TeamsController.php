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
        dump($team->checkExistUserInTeam(3,$request->user()->id));
        dd();
        $message = $team->show($request->user()->id);
        if (!empty($message)) {
            return response()->json($message, 200);
        }
        return response()->json(['message' => 'Permission error'], 401);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
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
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
            'team_name' => 'string|max:255',
            'users_mail' => 'array',
        ]);
        $team = new Team();
        $message = $team->updateTeam($request->id,$request->team_name,$request->users_mail,$request->user()->id);
        if (!empty($message)) {
            return response()->json('Team have been successfully update', 200);
        }
        return response()->json(['message' => 'Update error'], 400);
    }
    public function delete(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255'
        ]);
        $id_user = $request->user()->id;
        $team = new Team();
        $message = $team->deleteTeam($id_user,$request->id);
        if (!empty($message)) {
            return response()->json('Team have been successfully delete', 200);
        }
        return response()->json(['message' => 'Delete error'], 400);
    }
}

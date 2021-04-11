<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class  TablesController extends Controller
{
    public function showPublic(): JsonResponse
    {
        $table = new Table();
        return response()->json($table->getPublicTable(), 200);
    }

    public function showPublicDetails(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
        ]);
        $table = new Table();
        $content = $table->getPublicContent($request->id);
        if (!empty($content)) {
            return response()->json($content, 200);
        }
        return response()->json(['message' => 'No permission to view'], 403);
    }

    public function showPrivate(Request $request): JsonResponse
    {
        $table = new Table();
        $user_id = $request->user()->id;
        $tables = $table->getPrivateTable($user_id);
        return response()->json($tables, 200);
    }

    public function showPrivateDetails(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
        ]);
        $table = new Table();
        $user_id = $request->user()->id;
        $content = $table->getPrivateContent($request->id, $user_id);
        if (!empty($content)) {
            return response()->json($content, 200);
        }
        return response()->json(['message' => 'No permission to view'], 403);
    }

    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user_name =  (string) $request->user()->name;
        $user_id =(int) $request->user()->id;
        $table_name = (string) $request->name;
        $table = new Table();
        $message = $table->new($table_name,$user_name,$user_id);
        if (!empty($message)) {
            return response()->json('Table have been successfully created', 200);
        }

        return response()->json(['message' => 'Creation error'], 400);
    }

    public function update(Request $request): JsonResponse
    {
        return response()->json(0, 200);
    }

    public function delete(Request $request): JsonResponse
    {
        return response()->json(0, 200);
    }
}

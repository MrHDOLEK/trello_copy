<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
            'task_name' => 'required|string|max:255',
            'task_content' => 'required|max:255',
        ]);
        $task = new Task();
        $message = $task->createTask($request->id,$request->task_name,$request->task_content,$request->user()->id);
        if (!empty($message)) {
            return response()->json([
                'message' => 'Task have been successfully created',
                'task' => $message
                ], 200);
        }
        return response()->json(['message' => 'Creation error'], 400);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
            'task_name' => 'required|string|max:255',
            'task_content' => 'required|json|max:255',
        ]);
        $task = new Task();
        $message = $task->updateTask($request->id,$request->task_name,$request->task_content,$request->user()->id);
        if (!empty($message)) {
            return response()->json('Task have been successfully update', 200);
        }
        return response()->json(['message' => 'Update error'], 400);

    }

    public function delete(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
        ]);
        $task = new Task();
        $message = $task->deleteTask($request->id,$request->user()->id);
        if (!empty($message)) {
            return response()->json('Task have been successfully delete', 200);
        }
        return response()->json(['message' => 'Delete error'], 400);
    }
}

<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class  TablesController extends Controller
{
    public function showPublic() : JsonResponse
    {
        $table = new Table();
        return response()->json($table->getPublic(),200);
    }
    public function showPublicDetails(Request  $request) : JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
        ]);
        $table = new Table();
        return response()->json($table->getCards($request->id),200);
    }
    public function showPrivate() : JsonResponse
    {
        return response()->json(0,200);
    }
    public function showPrivateDetails() : JsonResponse
    {
        return response()->json(0,200);
    }
    public function create() : JsonResponse
    {
        return response()->json(0,200);
    }
    public function update() : JsonResponse
    {
        return response()->json(0,200);
    }
    public function delete() : JsonResponse
    {
        return response()->json(0,200);
    }
}

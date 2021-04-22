<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleType;
use Illuminate\Http\Request;

class ManageArticleTypesController extends Controller
{
    public function create(Request $request) {
        $type = new ArticleType([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $type->save();

        return response([
            'message' => 'Success! Type has been created!',
            200
        ]);
    }

    public function get(Request $request) {
        if(!empty($request->type_id))
            return ArticleType::findOrFail($request->type_id);

        return ArticleType::all();
    }

    public function update(Request $request) {
        $type = ArticleType::findOrFail($request->type_id);
        $type->update($request->all());

        return response([
            'message' => 'Success! Type has been updated!',
            200
        ]);
    }

    public function delete(Request $request) {
        $type = ArticleType::findOrFail($request->type_id);
        $type->delete();

        return response([
            'message' => 'Success! Type has been deleted!',
            200
        ]);
    }
}

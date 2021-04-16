<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ManageArticleCategoriesController extends Controller
{
    public function create(Request $request) {
        $category = new ArticleCategory([
           'name' => $request->name,
           'description' => $request->description
        ]);

        $category->save();

        return response([
            'message' => 'Success! Category has been created!'
        ]);
    }

    public function get(Request $request) {
        if(!empty($request->category_id))
            return ArticleCategory::findOrFail($request->category_id);

        return ArticleCategory::all();
    }

    public function update(Request $request) {
        $category = ArticleCategory::findOrFail($request->category_id);
        $category->update($request->all());

        return response([
            'message' => 'Success! Category has been updated!'
        ]);
    }

    public function delete(Request $request) {
        $category = ArticleCategory::findOrFail($request->category_id);
        $category->delete();

        return response([
            'message' => 'Success! Category has been deleted!'
        ]);
    }
}

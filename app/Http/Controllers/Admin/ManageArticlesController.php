<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ManageArticlesController extends Controller
{
    public function create(Request $request) {

        $article = new Article([
            'title' => (string)$request->title,
            'intro' => (string)$request->intro,
            'alias' => (string)$request->alias,
            'full' => (string)$request->full,
            'style' => (integer)$request->style,
            'image' => (binary)$request->image,
            'removable' => (boolean)$request->removable,
            'parameters' => json_encode($request->parameters),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id
        ]);

        $article->save();

        return response([
            'message' => 'Success! Article has been created!',
            200
        ]);
    }

    public function get(Request $request) {
        if(!empty($request->article_id))
            return Article::findOrFail($request->article_id);

        return Article::all();
    }

    public function update(Request $request) {
        $article = Article::findOrFail($request->article_id);
        $article->update($request->all());

        return response([
            'message' => 'Success! Article has been updated!',
            200
        ]);
    }

    public function delete(Request $request) {
        $article = Article::findOrFail($request->article_id);
        $article->delete();

        return response([
            'message' => 'Success! Article has been deleted!',
            200
        ]);
    }
}

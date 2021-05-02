<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageArticleTypesController extends Controller
{
    public function create(Request $request): Response {
        $article_type = new ArticleType();
        $article_type->createArticleType($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]));

        return response([
            'message' => 'Success! Type has been created!'],
            200
        );
    }

    public function get(Request $request): Response {
        $article_type = new ArticleType();
        $data = $article_type->getArticleTypes($request->validate([
            'article_type_id' => 'integer|max:255'
        ]));

        return response(
            $data,
            200
        );
    }

    public function update(Request $request): Response {
        $article_type = new ArticleType();
        $article_type->updateArticleType($request->validate([
            'article_type_id' => 'required|integer|max:255',
            'name' => 'string|max:255',
            'description' => 'string'
        ]));

        return response(
            'Success! Type has been updated!',
            200
        );
    }

    public function delete(Request $request): Response {
        $article_type = new ArticleType();
        $article_type->deleteArticleType($request->validate([
            'article_type_id' => 'required|integer|max:255'
        ]));

        return response(
            'Success! Type has been deleted!',
            200
        );
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageArticlesController extends Controller
{
    public function create(Request $request): Response {
        $article = new Article();
        $article->createArticle($request->validate([
            'title' => 'required|string|max:255',
            'intro' => 'string',
            'alias' => 'required|string|max:255',
            'full' => 'string',
            'style' => 'integer|max:255',
            'removable' => 'required|boolean',
            'meta_title' => 'string|max:255',
            'meta_description' => 'string',
            'category_id' => 'required|integer|max:255',
            'type_id' => 'required|integer|max:255'
            ])
        );

        return response(
            'Success! Article has been created!',
            200);
    }

    public function get(Request $request): Response {
        $article = new Article();
        $data = $article->getArticles($request->validate([
            "article_id" => "integer|max:255"
        ]));

        return response(
            $data,
            200);
    }

    public function update(Request $request): Response {
        $article = new Article();
        $article->updateArticle($request->validate([ //better way to do id validation???
            'article_id' => 'required|integer|max:255',
            'title' => 'string|max:255',
            'intro' => 'string',
            'alias' => 'string|max:255',
            'full' => 'string',
            'style' => 'integer|max:255',
            'removable' => 'boolean',
            'meta_title' => 'string|max:255',
            'meta_description' => 'string',
            'category_id' => 'integer|max:255',
            'type_id' => 'integer|max:255'
        ]));

        return response(
            'Success! Article has been updated!',
            200);
    }

    public function delete(Request $request): Response {
        $article = new Article();
        $article->deleteArticle($request->validate([
            "article_id" => "required|integer|max:255"
        ]));

        return response(
            'Success! Article has been deleted!',
            200);
    }
}

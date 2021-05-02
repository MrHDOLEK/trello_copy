<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageArticleCategoriesController extends Controller
{
    public function create(Request $request): Response {
        $article_category = new ArticleCategory();
        $article_category->createArticleCategory($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]));

        return response(
            'Success! Category has been created!',
            200
        );
    }

    public function get(Request $request): Response {
        $article_category = new ArticleCategory();
        $data = $article_category->getArticleCategories($request->validate([
            "article_category_id" => "integer|max:255"
        ]));

        return response($data,200);
    }

    public function update(Request $request): Response {
        $article_category = new ArticleCategory();
        $article_category->updateArticleCategory($request->validate([
            'article_category_id' => 'required|integer|max:255',
            'name' => 'string|max:255',
            'description' => 'string'
        ]));

        return response(
            'Success! Category has been updated!',
            200
        );
    }

    public function delete(Request $request): Response {
        $article_category = new ArticleCategory();
        $article_category->deleteArticleCategory($request->validate([
            'article_category_id' => 'required|integer|max:255'
        ]));

        return response(
            'Success! Category has been deleted!',
            200
        );
    }
}

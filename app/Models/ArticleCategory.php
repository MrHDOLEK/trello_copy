<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = [
        'name','description'
    ];

    public function article() {
        return $this->belongsToMany(Article::class);
    }

    public function createArticleCategory($validated) {
        ArticleCategory::create($validated);
    }

    public function getArticleCategories($validated) {
        if(!empty($validated))
            return ArticleCategory::findOrFail($validated);

        return ArticleCategory::all();
    }

    public function updateArticleCategory($validated) {
        $article_category = ArticleCategory::findOrFail($validated['article_category_id']);
        $article_category->update($validated);
    }

    public function deleteArticleCategory($validated) {
        $article_category = ArticleCategory::findOrFail($validated)->first();
        $article_category->delete();
    }
}

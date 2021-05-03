<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title','intro','alias','full','style','image','removable',
        'parameters','meta_title','meta_description','category_id','type_id'
    ];

    public function article_category() {
        return $this->hasOne(ArticleCategory::class);
    }

    public function article_type() {
        return $this->hasOne(ArticleType::class);
    }

    public function createArticle($validated) {
        Article::create($validated);
    }

    public function getArticles($validated) {
        if(!empty($validated))
            return Article::findOrFail($validated);

        return Article::all();
    }

    public function updateArticle($validated) {
        $article = Article::findOrFail($validated['article_id']);
        $article->update($validated);
    }

    public function deleteArticle($validated) {
        $article = Article::findOrFail($validated)->first();
        $article->delete();
    }
}

<?php

namespace App\Models;

use Dotenv\Repository\AdapterRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    use HasFactory;

    protected $table = 'article_types';

    protected $fillable = [
        'name','description'
    ];

    public function article() {
        return $this->belongsToMany(Article::class);
    }

    public function createArticleType($validated) {
        ArticleType::create($validated);
    }

    public function getArticleTypes($validated) {
        if(!empty($validated))
            return ArticleType::findOrFail($validated);

        return ArticleType::all();
    }

    public function updateArticleType($validated) {
        $article_type = ArticleType::findOrFail($validated['article_type_id']);
        $article_type->update($validated);
    }

    public function deleteArticleType($validated) {
        $article_type = ArticleType::findOrFail($validated['article_type_id']);
        $article_type->delete();
    }
}

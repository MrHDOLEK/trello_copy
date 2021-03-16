<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function article_category() {
        return $this->hasOne(ArticleCategory::class);
    }

    public function article_type() {
        return $this->hasOne(ArticleType::class);
    }
}

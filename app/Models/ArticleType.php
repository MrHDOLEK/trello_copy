<?php

namespace App\Models;

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
}

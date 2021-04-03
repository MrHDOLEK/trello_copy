<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title','intro','alias','full','style','image','removable','parameters','meta_title','meta_description'
    ];

    protected $hidden = [
        'category_id','type_id'
    ];

    public function article_category() {
        return $this->hasOne(ArticleCategory::class);
    }

    public function article_type() {
        return $this->hasOne(ArticleType::class);
    }
}

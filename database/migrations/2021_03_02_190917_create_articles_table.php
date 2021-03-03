<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('intro')->nullable();
            $table->string('alias')->nullable();
            $table->text('full')->nullable();
            $table->string('style');
            $table->binary('image')->nullable();
            $table->boolean('removable');
            $table->json('parameters')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->foreignId('type_id')
                    ->references('id')
                    ->on('article_types');

            $table->foreignId('category_id')
                    ->references('id')
                    ->on('article_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

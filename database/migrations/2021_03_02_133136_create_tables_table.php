<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('users');
            $table->boolean('isVisible');
            $table->timestamps();

            $table->foreignId('creator')
                    ->references('id')
                    ->on('users');

            $table->foreignId('theme_id')
                    ->references('id')
                    ->on('themes');

            $table->foreignId('team')
                    ->references('id')
                    ->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}

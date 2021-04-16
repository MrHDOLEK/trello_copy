<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class  CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_name');
            $table->json('card_content')->nullable();
            $table->integer('card_type');
            $table->timestamps();

<<<<<<< HEAD
            $table->foreignId('table_id')->constrained()->cascadeOnDelete();
=======
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
>>>>>>> bf5cdb31afc87c81c795d5311ba4d2840a740d58
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}

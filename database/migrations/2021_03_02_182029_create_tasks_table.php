<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->json('task_content')->nullable();
            $table->integer('task_type');
            $table->timestamps();

<<<<<<< HEAD
            $table->foreignId('card_id')->constrained()->cascadeOnDelete();
=======
            $table->foreignId('card_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('tasks');
    }
}

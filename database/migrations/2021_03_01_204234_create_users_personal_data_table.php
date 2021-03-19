<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPersonalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_personal_data', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->binary('avatar')->nullable();
            $table->boolean('regulation_accepted');
            $table->string('address');
            $table->timestamps();

            $table->foreignId('user_id')
                     ->references('id')
                     ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_personal_data');
    }
}

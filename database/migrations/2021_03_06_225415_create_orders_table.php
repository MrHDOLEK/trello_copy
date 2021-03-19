<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('status');
            $table->boolean('invoice');
            $table->json('invoice_data');
            $table->string('hash');
            $table->timestamps();

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users');

            $table->foreignId('subscription_id')
                    ->references('id')
                    ->on('packets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

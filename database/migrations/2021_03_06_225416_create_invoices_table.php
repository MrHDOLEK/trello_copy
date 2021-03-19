<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('symbol');
            $table->double('brutto');
            $table->string('currency');
            $table->double('netto');
            $table->integer('vat');
            $table->json('buyer');
            $table->json('items');
            $table->integer('type');
            $table->binary('pdf');
            $table->timestamps();

            $table->foreignId('order_id')
                    ->references('id')
                    ->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

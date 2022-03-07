<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenbaOrderLogsShredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genba_order_logs_shred', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('genba_order_logs_id')->unsigned();
            $table->string('genba_product_id');
            $table->string('sku');
            $table->integer('state')->nullable();
            $table->json('keys');
            $table->string('order_created_time');
            $table->string('one_time_token');
            $table->float('sel_net_amount');
            $table->float('sel_gross_amount');
            $table->string('sel_currency_code');
            $table->float('ac_amount');
            $table->string('ac_currency_code');
            $table->string('client_transaction_id');
            $table->float('com_amount');
            $table->string('com_currency_code');

            $table->foreign('genba_order_logs_id')->references('id')->on('genba_order_logs');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genba_order_logs_shred');
    }
}

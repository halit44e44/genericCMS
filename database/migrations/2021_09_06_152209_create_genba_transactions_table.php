<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenbaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genba_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('genba_client_tokens_id')->unsigned();
            $table->bigInteger('genba_order_log_id')->unsigned();
            $table->bigInteger('genba_product_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->json('communicated_buying_price');
            $table->json('keys');
            $table->json('sale_price');
            $table->json('purchase_price');
            $table->timestamps();
            $table->foreign('genba_client_tokens_id')->references('id')->on('genba_client_tokens');
            $table->foreign('genba_order_log_id')->references('id')->on('genba_order_logs');
            $table->foreign('genba_product_id')->references('id')->on('genba_products');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genba_transactions');
    }
}

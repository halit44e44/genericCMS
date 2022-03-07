<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transactionId');
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('epinProduct_entity_id')->unsigned();
            $table->bigInteger('client_info_id')->unsigned();
            $table->integer('qty');
            $table->float('single_price');
            $table->float('total_price');
            $table->float('percentage');
            $table->float('percentage_single_price');
            $table->float('percentage_total_price');
            $table->string('status');
            $table->json('soldCodes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('epinProduct_entity_id')->references('id')->on('epin_product_entities');
            $table->foreign('client_info_id')->references('id')->on('clients_info');
            $table->index('transactionId');
            $table->index('company_id');
            $table->index('epinProduct_entity_id');
            $table->index('client_info_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('clients_info');
    }
}

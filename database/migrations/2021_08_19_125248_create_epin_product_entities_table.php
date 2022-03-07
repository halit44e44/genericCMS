<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpinProductEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epin_product_entities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('epinProduct_id')->unsigned();
            $table->integer('old_id')->nullable();
            $table->string('stock_code')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->float('price');
            $table->string('accounting_code');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('epinProduct_id')->references('id')->on('epin_products');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epin_product_entities');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenbaPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genba_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->string('regionCode');
            $table->string('currencyCode');
            $table->double('wsp');
            $table->double('srp');
            $table->boolean('isPromotion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')->references('id')->on('genba_products');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genba_prices');
    }
}

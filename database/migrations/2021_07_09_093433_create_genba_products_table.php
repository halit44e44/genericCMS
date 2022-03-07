<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenbaProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genba_products', function (Blueprint $table) {
            $table->id();
            $table->string('productID');
            $table->string('sku')->uniqid;
            $table->string('regionCode');
            $table->string('name');
            $table->string('isBundle')->nullable();
            $table->string('status')->default('active');
            $table->dateTime('details_sync')->nullable();
            $table->dateTime('price_sync')->nullable();
            $table->boolean('tr_price')->default(0);
            $table->boolean('en_price')->default(0);
            $table->boolean('eur_price')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unique('sku');
            $table->index(['sku','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genba_products');
    }
}

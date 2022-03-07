<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenbaProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genba_product_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->string('releaseDate');
            $table->string('digitalReleaseDate');
            $table->bigInteger('platform_id')->unsigned();
            $table->bigInteger('publisher_id')->unsigned();
            $table->bigInteger('developer_id')->unsigned();
            $table->integer('preLiveState');
            $table->boolean('IsBundle');
            $table->json('genres');
            $table->string('keyProvider');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('genba_products');
            $table->foreign('platform_id')->references('id')->on('platforms');
            $table->foreign('publisher_id')->references('id')->on('genba_publishers');
            $table->foreign('developer_id')->references('id')->on('genba_developers');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genba_product_details');
    }
}

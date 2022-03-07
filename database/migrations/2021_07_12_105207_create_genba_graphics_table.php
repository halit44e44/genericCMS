<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenbaGraphicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genba_graphics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->string('graphic_id');
            $table->string('graphicType');
            $table->string('fileSize');
            $table->string('fileName');
            $table->string('imageUrl');
            $table->string('cdnImageUrl')->nullable();
            $table->integer('originalWidth');
            $table->integer('OriginalHeight');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')->references('id')->on('genba_products');
            $table->index(['product_id','cdnImageUrl']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genba_graphics');
    }
}

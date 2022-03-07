<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('accountingCode')->nullable();
            $table->boolean('isActive')->default(1);
            $table->integer('maxTransactionLimit')->nullable();
            $table->integer('percentage')->nullable();
            $table->integer('limitControl')->nullable();
            $table->float('ballance')->default(0.0);
            $table->boolean('constantPercentage')->default(1);
            $table->boolean('sms')->default(1);
            $table->boolean('mail')->default(1);
            $table->boolean('unlimited')->default(1);
            $table->boolean('preOrders')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'accountingCode', 
                'isActive', 
                'maxTransactionLimit',  
                'percentage',  
                'limitControl',  
                'ballance',  
                'constantPercentage',  
                'sms',
                'mail',
                'unlimited',
                'preOrders',
            ]);
        });
    }
}

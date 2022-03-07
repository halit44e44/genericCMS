<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id')->unsigned();
            $table->string('branch_code')->nullable();
            $table->string('account_code')->nullable();
            $table->string('iban_no')->nullable();
            $table->string('account_owner')->nullable();
            $table->boolean('isActive')->nullable();
            // $table->boolean('status')->nullable();
            $table->string('description')->nullable();
            $table->foreign('bank_id')->references('id')->on('bank_definitions');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}

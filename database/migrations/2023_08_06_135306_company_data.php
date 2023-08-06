<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('worker_id')->unsigned();
            $table->string('company_name');
            $table->string('country');
            $table->string('city');
            $table->integer('zip_code');
            $table->string('address');
            $table->string('tel');
            $table->string('email');
            $table->integer('pib');
            $table->integer('maticni_broj');
            $table->string('tekuci_racun');
            $table->string('bank_account');
            $table->string('bank_name');
            $table->string('logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_data');
    }
}

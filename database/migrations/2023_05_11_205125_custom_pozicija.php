<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomPozicija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_pozicija', function (Blueprint $table) {
            $table->id()->startingValue(10000);
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('custom_subcategory_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->string('custom_title');
            $table->text('custom_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_pozicija');
    }
}

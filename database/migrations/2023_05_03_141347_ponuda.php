<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ponuda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponuda', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('ponuda_id')->unsigned();
            $table->bigInteger('categories_id')->unsigned();
            $table->bigInteger('subcategories_id')->unsigned();
            $table->bigInteger('pozicija_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->double('unit_price')->unsigned();
            $table->double('overall_price')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponuda');
    }
}

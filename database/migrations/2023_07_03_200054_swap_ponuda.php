<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SwapPonuda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swap_ponuda', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('original_id')->unsigned();
            $table->bigInteger('swap_id')->unsigned();
            $table->string('temp_ponuda_name');
            $table->string('temp_note')->nullable();
            $table->text('temp_opis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swap_ponuda');
    }
}

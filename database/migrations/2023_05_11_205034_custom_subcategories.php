<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomSubcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_subcategories', function (Blueprint $table) {
            $table->id()->startingValue(2000);
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('custom_category_id')->unsigned();
            $table->string('name');
            $table->tinyInteger('is_subcategory_deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_subcategories');
    }
}

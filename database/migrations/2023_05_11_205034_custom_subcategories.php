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
            $table->foreignIdFor(\App\Models\Worker::class,'worker_id')->constrained();
            $table->bigInteger('custom_category_id')->unsigned();
            $table->string('name');
            $table->tinyInteger('is_subcategory_deleted')->nullable();
            $table->boolean('has_pozicija');
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

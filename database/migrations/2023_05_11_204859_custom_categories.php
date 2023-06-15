<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_categories', function (Blueprint $table) {
            $table->id()->startingValue(500);
            $table->bigInteger('worker_id')->unsigned();
            $table->string('name');
            $table->tinyInteger('is_category_deleted')->nullable();
        });
        DB::table('custom_categories')->insert(
            array(
                'worker_id' => '1',
                'name' => 'Worker Custom'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subcategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('name');
        });
        DB::table('subcategories')->insert(
            array(
                [
                    'category_id' => '1',
                    'name' => 'Pripremni radovi'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Unutrašnji zidovi i plafoni'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Vrata i prozori'
                ],
                [
                    'category_id' => '1',
                    'name' => 'Fasada'
                ]
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
        Schema::dropIfExists('subcategories');
    }
}

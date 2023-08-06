<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CitiesWithZipcodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->integer('zip_code');
            $table->integer('country_id');
        });
        DB::table('cities')->insert(
            array( 
                [
                    'city' => 'Ada',
                    'zip_code' => '24430',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Adasevci',
                    'zip_code' => '22244',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Adorjan',
                    'zip_code' => '24425',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Adrani',
                    'zip_code' => '36203',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aleksinacki Rudnik',
                    'zip_code' => '18226',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aleksa Santic',
                    'zip_code' => '25212',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aleksandrovac',
                    'zip_code' => '37230',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aleksandrovac',
                    'zip_code' => '12370',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aleksandrovo',
                    'zip_code' => '23217',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aleksinac',
                    'zip_code' => '18220',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Alibunar',
                    'zip_code' => '26310',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aljinovici',
                    'zip_code' => '31307',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Apatin',
                    'zip_code' => '25260',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Aradac',
                    'zip_code' => '23207',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Arandjelovac',
                    'zip_code' => '34303',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Arandjelovac',
                    'zip_code' => '34300',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Arilje',
                    'zip_code' => '31230',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Asanja',
                    'zip_code' => '22418',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Azanja',
                    'zip_code' => '11423',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Babin Kal',
                    'zip_code' => '18315',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Babusnica',
                    'zip_code' => '18330',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Bac',
                    'zip_code' => '21420',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Bacevci',
                    'zip_code' => '31258',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Bacina',
                    'zip_code' => '37265',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Bacinci',
                    'zip_code' => '22225',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Backa Palanka',
                    'zip_code' => '21400',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Backa Topola',
                    'zip_code' => '24300',
                    'country_id' => '1',
                ],
                [
                    'city' => 'Backi Breg',
                    'zip_code' => '25275',
                    'country_id' => '1',
                ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],
                // [
                //     'city' => '',
                //     'zip_code' => ''
                // ],

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
        //
    }
}

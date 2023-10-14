<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('browser_agent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chrome')->default(0);
            $table->unsignedBigInteger('firefox')->default(0);
            $table->unsignedBigInteger('opera')->default(0);
            $table->unsignedBigInteger('safari')->default(0);
            $table->unsignedBigInteger('ie')->default(0);
            $table->unsignedBigInteger('edge')->default(0);
            $table->unsignedBigInteger('unknown')->default(0);
            $table->date('date')->default(date('Y-m-d'));
        });

        DB::table('browser_agent')->insert([
            'chrome' => 0,
            'firefox' => 0,
            'opera' => 0,
            'safari' => 0,
            'ie' => 0,
            'edge' => 0,
            'unknown' => 0,
            'date' => date('Y-m-d'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('browser_agent');
    }
};

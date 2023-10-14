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
        Schema::create('device_agent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobile')->default(0);
            $table->unsignedBigInteger('tablet')->default(0);
            $table->unsignedBigInteger('desktop')->default(0);
            $table->unsignedBigInteger('bot')->default(0);
            $table->unsignedBigInteger('unknown')->default(0);
            $table->date('date')->default(date('Y-m-d'));
        });

        DB::table('device_agent')->insert([
            'mobile' => 0,
            'tablet' => 0,
            'desktop' => 0,
            'bot' => 0,
            'unknown' => 0,
            'date' => date('Y-m-d'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_agent');
    }
};

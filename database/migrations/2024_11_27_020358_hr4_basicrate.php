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
        Schema::create('hr4_basicrate', function (Blueprint $table) {
            $table->id('basicrate_id');
            $table->string('position_id')->nullable();
            $table->string('basic_pay_range')->nullable();
            $table->string('daily_rate')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

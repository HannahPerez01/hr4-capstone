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
                
        Schema::create('hr4_summary_table', function (Blueprint $table) {
            $table->id('summary_id');
            $table->string('position_id')->nullable();
            $table->string('basic_pay')->nullable();
            $table->string('restday')->nullable();
            $table->string('regularday')->nullable();
            $table->string('allowance')->nullable();
            $table->string('bonuses')->nullable();
            $table->string('fringe_benefit')->nullable();
            $table->string('totalcompensation')->nullable();
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

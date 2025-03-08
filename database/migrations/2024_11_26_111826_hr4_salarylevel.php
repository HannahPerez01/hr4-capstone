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
        Schema::create('hr4_salarylevel', function (Blueprint $table) {
            $table->id('salarylevel_id');
            $table->string('levelname');
            $table->string('position_id')->nullable();
            $table->string('step1')->nullable();
            $table->string('step2')->nullable();
            $table->string('step3')->nullable();
            $table->string('step4')->nullable();
            $table->string('step5')->nullable();
            $table->string('step6')->nullable();
            $table->string('step7')->nullable();
            $table->string('step8')->nullable();
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

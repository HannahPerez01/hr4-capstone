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
          Schema::create('hr3_shift_and_scheduling', function (Blueprint $table) {
      $table->id();
            $table->string('employee_id')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('shift_start')->nullable();
            $table->string('shift_end')->nullable();
            $table->string('shift_type')->nullable();
            $table->string('shift_date')->nullable();
            $table->timestamps();
  //
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

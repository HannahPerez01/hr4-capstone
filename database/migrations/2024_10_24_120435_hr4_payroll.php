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
       
         Schema::create('hr4_payroll', function (Blueprint $table) {
      $table->id('payroll_id');
            $table->string('attendance_id')->nullable();
            $table->string('deduction_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('status')->nullable();
            $table->string('date')->nullable();
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

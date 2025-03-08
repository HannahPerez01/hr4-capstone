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
         Schema::create('core1_employee', function (Blueprint $table) {
         $table->id('employee_id');
         $table->string('employee_code')->nullable();
         $table->string('firstname')->nullable();
         $table->string('middlename')->nullable();
         $table->string('lastname')->nullable();
         $table->string('position')->nullable();
         $table->string('contact')->nullable();
         $table->string('email')->nullable();
         $table->string('trainee_fee')->nullable();
         $table->string('description')->nullable();
         $table->string('image')->nullable();
         $table->string('status')->nullable();
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

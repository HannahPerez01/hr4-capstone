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
               Schema::create('hr4_compensation', function (Blueprint $table) {
      $table->id('compensation_id');
            $table->string('employee_id')->nullable();
            $table->string('project_name')->nullable();
            $table->string('compensation_type')->nullable();
            $table->string('amount')->nullable();
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

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
    
   Schema::create('hr2_job_qualification', function (Blueprint $table) {
      $table->id('job_id');
            $table->string('job_request_id')->nullable();
            $table->string('description')->nullable();
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

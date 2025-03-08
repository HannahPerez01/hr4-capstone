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
        Schema::create('applications', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Applicant's name
            $table->string('email')->unique(); // Applicant's email
            $table->string('gender'); // Gender field
            $table->string('address'); // Address field
            $table->string('contact_number'); // Contact number field
            $table->string('job_position'); // Job position applied for
            $table->text('resume');
            $table->string('status')->nullable();
            $table->string('department')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      
    }
};

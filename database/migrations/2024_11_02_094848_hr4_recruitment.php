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
        Schema::create('hr4_recruitment', function (Blueprint $table) {
      $table->id('recruitment_id');
            $table->string('jobrole')->nullable();
            $table->string('department')->nullable();
            $table->string('status')->nullable();
            $table->string('salary')->nullable();
            $table->string('time')->nullable();
            $table->string('Description')->nullable();
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

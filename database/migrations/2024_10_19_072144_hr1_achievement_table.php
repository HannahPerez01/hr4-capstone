<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // For the name of the achievement
            $table->text('achievement'); // For the achievement description
            $table->integer('score'); // For the score
            $table->timestamps(); // Created at and updated at timestamps
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};

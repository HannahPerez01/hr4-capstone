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
        Schema::table('hr4_compensation', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->change();
            $table->renameColumn('project_name', 'transaction_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hr4_compensation', function (Blueprint $table) {
            $table->string('employee_id')->change();
            $table->renameColumn('transaction_type', 'project_name');
        });
    }
};

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
        Schema::table('hr1_employee_info', function (Blueprint $table) {
            $table->string('employee_code')->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hr1_employee_info', function (Blueprint $table) {
            $table->dropColumn('employee_code');
        });
    }
};

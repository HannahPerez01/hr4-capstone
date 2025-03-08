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
            $table->string('gender')->after('generate_code')->nullable();
            $table->unsignedBigInteger('job_position_id')->after('gender')->nullable();
            $table->string('department')->after('job_position_id')->nullable();
            $table->string('employment_type')->after('department')->nullable();
            $table->date('date_hired')->after('employment_type')->nullable();
            $table->string('status')->after('date_hired')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hr1_employee_info', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('job_position_id');
            $table->dropColumn('department');
            $table->dropColumn('employment_type');
            $table->dropColumn('date_hired');
            $table->dropColumn('status');
        });
    }
};

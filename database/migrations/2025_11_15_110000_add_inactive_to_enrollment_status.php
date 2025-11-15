<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'inactive' to the enum values for enrollment_status
        DB::statement("ALTER TABLE `course_enrollments` MODIFY `enrollment_status` ENUM('active','completed','cancelled','suspended','inactive') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `course_enrollments` MODIFY `enrollment_status` ENUM('active','completed','cancelled','suspended') NOT NULL DEFAULT 'active'");
    }
};

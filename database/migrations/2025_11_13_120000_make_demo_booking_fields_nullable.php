<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Use raw SQL to avoid requiring doctrine/dbal for column changes
        DB::statement("ALTER TABLE `demo_bookings` MODIFY `email` VARCHAR(255) NULL, MODIFY `phone` VARCHAR(255) NULL, MODIFY `preferred_date` DATE NULL, MODIFY `preferred_time` TIME NULL");
    }

    public function down()
    {
        // Revert changes: make columns NOT NULL and set sensible defaults
        DB::statement("ALTER TABLE `demo_bookings` MODIFY `email` VARCHAR(255) NOT NULL DEFAULT '', MODIFY `phone` VARCHAR(255) NOT NULL DEFAULT '', MODIFY `preferred_date` DATE NOT NULL DEFAULT '1970-01-01', MODIFY `preferred_time` TIME NOT NULL DEFAULT '00:00:00'");
    }
};

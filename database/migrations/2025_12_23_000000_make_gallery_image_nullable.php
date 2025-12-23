<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Make the `image` column nullable so video-only items can be saved without an image.
        // Use raw SQL to avoid requiring the doctrine/dbal package.
        DB::statement("ALTER TABLE `galleries` MODIFY `image` VARCHAR(255) NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert column to NOT NULL. Note: this will fail if NULL values exist.
        DB::statement("ALTER TABLE `galleries` MODIFY `image` VARCHAR(255) NOT NULL;");
    }
};

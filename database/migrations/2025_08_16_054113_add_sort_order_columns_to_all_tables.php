<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add sort_order to categories table if it doesn't exist
        if (!Schema::hasColumn('categories', 'sort_order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        // Add sort_order to courses table if it doesn't exist
        if (!Schema::hasColumn('courses', 'sort_order')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        // Add sort_order to galleries table if it doesn't exist
        if (!Schema::hasColumn('galleries', 'sort_order')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        // Add sort_order to testimonials table if it doesn't exist
        if (!Schema::hasColumn('testimonials', 'sort_order')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        // Add sort_order to faqs table if it doesn't exist
        if (!Schema::hasColumn('faqs', 'sort_order')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        // Add sort_order to offers table if it doesn't exist
        if (!Schema::hasColumn('offers', 'sort_order')) {
            Schema::table('offers', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove sort_order columns
        if (Schema::hasColumn('categories', 'sort_order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasColumn('courses', 'sort_order')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasColumn('galleries', 'sort_order')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasColumn('testimonials', 'sort_order')) {
            Schema::table('testimonials', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasColumn('faqs', 'sort_order')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasColumn('offers', 'sort_order')) {
            Schema::table('offers', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};

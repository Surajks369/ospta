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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('instructor')->nullable()->after('level');
            $table->text('instructor_bio')->nullable()->after('instructor');
            $table->text('learning_objectives')->nullable()->after('instructor_bio');
            $table->text('requirements')->nullable()->after('learning_objectives');
            $table->text('curriculum')->nullable()->after('requirements');
            $table->string('language')->default('English')->after('curriculum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'instructor',
                'instructor_bio',
                'learning_objectives', 
                'requirements',
                'curriculum',
                'language'
            ]);
        });
    }
};

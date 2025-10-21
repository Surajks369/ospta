<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolDetailsToUserRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('user_registrations', function (Blueprint $table) {
            $table->string('current_school')->nullable()->after('qualification');
            $table->string('school_grade')->nullable()->after('current_school');
            $table->string('school_board')->nullable()->after('school_grade');
        });
    }

    public function down()
    {
        Schema::table('user_registrations', function (Blueprint $table) {
            $table->dropColumn(['current_school', 'school_grade', 'school_board']);
        });
    }
}
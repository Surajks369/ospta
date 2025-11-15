<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            // Personal details
            $table->string('name')->nullable()->after('course_id');
            $table->string('email')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('gender');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');
            $table->string('qualification')->nullable()->after('pincode');

            // School details
            $table->string('current_school')->nullable()->after('qualification');
            $table->string('school_grade')->nullable()->after('current_school');
            $table->string('school_board')->nullable()->after('school_grade');

            // Parent details
            $table->string('parent_name')->nullable()->after('school_board');
            $table->string('parent_phone')->nullable()->after('parent_name');
            $table->string('parent_email')->nullable()->after('parent_phone');
            $table->string('parent_occupation')->nullable()->after('parent_email');
        });
    }

    public function down()
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'name','email','phone','date_of_birth','gender','address','city','state','pincode','qualification',
                'current_school','school_grade','school_board','parent_name','parent_phone','parent_email','parent_occupation'
            ]);
        });
    }
};

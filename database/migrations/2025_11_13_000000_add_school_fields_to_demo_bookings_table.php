<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('demo_bookings', function (Blueprint $table) {
            $table->string('student_name')->nullable()->after('name');
            $table->string('school_name')->nullable()->after('student_name');
            $table->text('school_address')->nullable()->after('school_name');
            $table->string('contact_person')->nullable()->after('school_address');
            $table->string('contact_designation')->nullable()->after('contact_person');
            $table->string('contact_phone')->nullable()->after('contact_designation');
            $table->string('contact_email')->nullable()->after('contact_phone');
        });
    }

    public function down()
    {
        Schema::table('demo_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'student_name',
                'school_name',
                'school_address',
                'contact_person',
                'contact_designation',
                'contact_phone',
                'contact_email',
            ]);
        });
    }
};

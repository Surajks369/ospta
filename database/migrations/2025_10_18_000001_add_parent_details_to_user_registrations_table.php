<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentDetailsToUserRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('user_registrations', function (Blueprint $table) {
            $table->string('parent_name')->nullable()->after('gender');
            $table->string('parent_phone')->nullable()->after('parent_name');
            $table->string('parent_email')->nullable()->after('parent_phone');
            $table->string('parent_occupation')->nullable()->after('parent_email');
        });
    }

    public function down()
    {
        Schema::table('user_registrations', function (Blueprint $table) {
            $table->dropColumn(['parent_name', 'parent_phone', 'parent_email', 'parent_occupation']);
        });
    }
}
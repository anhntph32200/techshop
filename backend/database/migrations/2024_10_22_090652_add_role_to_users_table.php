<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm trường role
            $table->string('role')->default('user');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Xóa trường role
            $table->dropColumn('role');
        });
    }
}


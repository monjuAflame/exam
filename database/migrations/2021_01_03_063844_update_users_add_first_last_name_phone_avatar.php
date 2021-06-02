<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersAddFirstLastNamePhoneAvatar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name', 50)->nullable()->after('name');
            $table->string('phone', 20)->after('last_name')->unique();
            $table->string('avatar', 100)->nullable()->after('password');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('avatar');
            $table->dropSoftDeletes();
        });
    }
}

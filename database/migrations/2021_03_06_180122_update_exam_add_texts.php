<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExamAddTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->text('intro_text')->nullable()->default(null);
            $table->text('conclusion_text')->nullable()->default(null);
            $table->text('pass_message')->nullable()->default(null);
            $table->text('fail_message')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('intro_text');
            $table->dropColumn('conclusion_text');
            $table->dropColumn('pass_message');
            $table->dropColumn('fail_message');

        });
    }
}

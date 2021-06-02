<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExamsAddPassMarkDeleteQuestionSetId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {

            $table->dropColumn('question_set_id');
            $table->integer('passing_score')->unsigned()->default(0)->before('created_at');
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
            $table->integer('question_set_id')->unsigned()->before('created_at');
            $table->dropColumn('passing_score');
        });
    }
}

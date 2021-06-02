<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotQuestionAndExamSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_question_and_exam_set', function (Blueprint $table) {
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();

            $table->primary(['question_id', 'exam_id']);

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_question_and_exam_set');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotQuestionAndQuestionSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_question_and_question_set', function (Blueprint $table) {
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('question_set_id')->unsigned();

            $table->primary(['question_id', 'question_set_id'], 'question_with_sets_primary');

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('question_set_id')->references('id')->on('question_sets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_question_and_question_set');
    }
}

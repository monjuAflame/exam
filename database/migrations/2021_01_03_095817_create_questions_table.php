<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->default('MCQ');
            $table->string('title', 100)->nullable();
            $table->json('options')->nullable()->default(null);
            $table->integer('mcq_answer_index')->unsigned()->nullable();
            $table->string('writter_answer')->nullable();
            $table->boolean('is_question_image')->default(false);
            $table->boolean('is_mcq_options_image')->default(false);
            $table->string('question_image')->nullable();
            $table->string('options_image')->nullable();
            $table->integer('mark')->unsigned();
            $table->integer('course_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('questions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('type', 20)->default('MCQ');
            $table->bigInteger('course_id')->unsigned();
            $table->integer('question_set_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('duration_in_minutes')->unsigned();
            $table->integer('total_marks')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}

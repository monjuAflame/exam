<?php

use App\Models\Course;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEnrolments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('batch_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('session')->nullable();
            $table->string('admission_type')->default(Course::ADMISSION_TYPE_MONTHLY);
            $table->integer('discount')->default(0);
            $table->timestamps();

            $table->unique(['course_id', 'batch_id', 'user_id']);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolments');
    }
}

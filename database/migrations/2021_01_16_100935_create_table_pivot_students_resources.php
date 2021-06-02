<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotStudentsResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_students_resources', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('course_resource_id')->unsigned();
            $table->timestamps();

            $table->primary(['user_id', 'course_resource_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_resource_id')->references('id')->on('course_resources')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_resources');
    }
}

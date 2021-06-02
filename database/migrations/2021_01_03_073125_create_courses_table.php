<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->default('Default Course Name');
            $table->string('code', 30)->nullable();
            $table->integer('fee')->unsigned()->default(0);
            $table->integer('course_category_id')->nullable(); // optional relation
            $table->integer('duration_in_weeks')->unsigned()->nullable()->default(1);
            $table->integer('total_class')->unsigned()->nullable();
            $table->integer('total_exam')->unsigned()->nullable();
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
        Schema::dropIfExists('courses');
    }
}

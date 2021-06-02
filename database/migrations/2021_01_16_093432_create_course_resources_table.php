<?php

use App\Models\CourseResource;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('resource_type')->nullable()->default(CourseResource::TYPE_NONE);
            $table->string('link')->nullable()->default(null);
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('uploader')->unsigned();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('uploader')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_resources');
    }
}

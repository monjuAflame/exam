<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotUserSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_user_sheet', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('sheet_id')->unsigned();
            $table->timestamps();

            $table->primary(['user_id', 'sheet_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sheet_id')->references('id')->on('sheets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_user_sheet');
    }
}

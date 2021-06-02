<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->datetime('date');
            $table->float('amount',8,2);
            $table->string('description', 80);
            $table->foreign('expense_id')->references('id')->on('expenses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_expenses');
    }
}

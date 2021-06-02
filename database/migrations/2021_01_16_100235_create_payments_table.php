<?php

use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->unsigned()->default(0);
            $table->string('method')->nullable()->default(Payment::METHOD_BKASH);
            $table->boolean('confirmed');
            $table->json('data')->nullable()->default(null);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('enrolment_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('enrolment_id')->references('id')->on('enrolments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}

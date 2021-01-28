<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->json('fee_id');
            $table->json('fee');
            $table->integer('fine');
            $table->integer('due');
            $table->integer('paid');
            $table->string('status');
            $table->string('payment_id');
            $table->string('fee_no');
            $table->date('due_date');
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
        Schema::dropIfExists('monthly_fees');
    }
}

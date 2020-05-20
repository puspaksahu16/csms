<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('school_id');
            $table->string('employee_unique_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('mobile');
            $table->string('email');
            $table->bigInteger('gender_id');
            $table->bigInteger('id_proof');
            $table->string('id_proof_no');
            $table->string('photo');
            $table->string('experience');
            $table->string('caste');
            $table->string('employee_qualification')->nullable();
            $table->string('employee_designation')->nullable();
            $table->string('employee_salary')->nullable();
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
        Schema::dropIfExists('employees');
    }
}

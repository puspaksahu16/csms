<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id');
            $table->bigInteger('class_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->bigInteger('gender_id');
            $table->bigInteger('id_proof');
            $table->string('id_proof_no');
            $table->string('tc_no');
            $table->string('photo');
            $table->string('family_photo');
            $table->string('upload_tc');
            $table->string('caste');
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
        Schema::dropIfExists('students');
    }
}

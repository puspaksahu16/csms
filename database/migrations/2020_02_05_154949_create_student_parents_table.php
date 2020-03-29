<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id');
            $table->string('father_first_name');
            $table->string('father_last_name');
            $table->string('father_qualification')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_mobile');
            $table->string('father_salary')->nullable();
            $table->bigInteger('father_id_type')->nullable();
            $table->string('father_id_no')->nullable();
            $table->string('father_email');
            $table->string('mother_first_name');
            $table->string('mother_last_name');
            $table->string('mother_qualification')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_mobile');
            $table->string('mother_salary')->nullable();
            $table->bigInteger('mother_id_type')->nullable();
            $table->string('mother_id_no')->nullable();
            $table->string('mother_email');
            $table->string('parent_type');
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
        Schema::dropIfExists('parents');
    }
}

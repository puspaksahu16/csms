<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('school_id');
            $table->integer('standard_id');
            $table->integer('class_id');
            $table->integer('section_id');
            $table->integer('subject_id');
            $table->integer('employee_id');
            $table->string('day');
            $table->integer('period_id');
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
        Schema::dropIfExists('time_tables');
    }
}

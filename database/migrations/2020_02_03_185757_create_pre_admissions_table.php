<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_admissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->tinyInteger('gender')->default(1);//male = 1 , female = 2
            $table->bigInteger('class_id');
            $table->tinyInteger('caste')->default(1);// gen = 1, obc = 2, sc = 3, st = 4
            $table->string('photo')->nullable();
            $table->tinyInteger('is_active')->default(1);//inactive = 0 , active = 1
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
        Schema::dropIfExists('pre_admissions');
    }
}

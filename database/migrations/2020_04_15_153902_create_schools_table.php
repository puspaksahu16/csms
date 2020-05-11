<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('registration_no');
            $table->string('full_name');
            $table->string('address');
            $table->string('affliation_no');
            $table->string('owner_name');
            $table->bigInteger('owner_contact_no');
            $table->string('owner_photo');
            $table->string('contact_person');
            $table->string('photo');
            $table->string('standard');
            $table->string('classes');
            $table->string('starting_year');
            $table->string('facility');
            $table->string('email')->unique();
            $table->integer('mobile');
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('schools');
    }
}

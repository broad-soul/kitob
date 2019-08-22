<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('place_of_education');
            $table->string('direction_code');
            $table->string('name');
            $table->string('surname');
            $table->string('father_name');
            $table->string('date_of_birth');
            $table->string('citizenship');
            $table->string('client_requisite');
            $table->string('residential_address');
            $table->string('school_region');
            $table->string('school_district');
            $table->string('school_number_or_name');
            $table->string('graduation_year');
            $table->string('education_language');
            $table->string('certificate_number');
            $table->string('act_number')->nullable();
            $table->string('phone');
            $table->string('documents_graduate_9_grade');
            $table->string('name_archive_with_data')->nullable();
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
        Schema::dropIfExists('residents');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_residents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direction_code');
            $table->string('name');
            $table->string('surname');
            $table->string('father_name');
            $table->string('date_of_birth');
            $table->string('citizenship');
            $table->string('client_requisite');
            $table->string('residential_address');
            $table->string('education_language');
            $table->string('phone');
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
        Schema::dropIfExists('non_residents');
    }
}

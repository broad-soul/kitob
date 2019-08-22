<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('photo');
            $table->string('name');
            $table->string('surname');
            $table->string('age')->nullable();
            $table->string('subject_en')->nullable();
            $table->string('subject_ru')->nullable();
            $table->string('subject_uz')->nullable();
            $table->text('about_me_en')->nullable();
            $table->text('about_me_ru')->nullable();
            $table->text('about_me_uz')->nullable();
            $table->string('is_visible')->default(0);
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
        Schema::dropIfExists('teachers');
    }
}

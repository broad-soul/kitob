<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainPageEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_page_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title_en')->nullable();
            $table->text('title_ru')->nullable();
            $table->text('title_uz')->nullable();
            $table->integer('visible')->default(1);
            $table->text('bgimage')->nullable();
            $table->longText('en');
            $table->longText('ru');
            $table->longText('uz');
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
        Schema::dropIfExists('main_page_event');
    }
}

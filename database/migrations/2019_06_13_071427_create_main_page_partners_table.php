<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainPagePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_page_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title_en')->nullable();
            $table->text('title_ru')->nullable();
            $table->text('title_uz')->nullable();
            $table->text('bgimage')->nullable();
            $table->string('visible')->default(0);
            $table->longText('content_en');
            $table->longText('content_ru');
            $table->longText('content_uz');
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
        Schema::dropIfExists('main_page_partners');
    }
}

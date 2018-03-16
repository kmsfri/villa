<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillaImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villa_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('villa_id')->unsigned();
            $table->foreign('villa_id')->references('id')->on('villa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image_dir');
            $table->string('image_order');
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
        Schema::dropIfExists('villa_images');
    }
}

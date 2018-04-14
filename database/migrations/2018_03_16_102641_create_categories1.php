<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategories1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories1', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_title');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('categories1')->onDelete('cascade')->onUpdate('cascade');
            $table->smallInteger('category_order')->unsigned()->default('1');
            $table->boolean('category_status')->default(1)->comment='0:deactive - 1:active';
            $table->string('category_slug')->unique()->charset('utf8');
            $table->string('image_dir')->nullable();
            $table->string('image_hover_dir')->nullable();
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
        Schema::dropIfExists('categories1');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('properties')->onDelete('cascade')->onUpdate('cascade');
            $table->string('prop_title');
            $table->boolean('has_text_value')->default(0)->comment="1: is used for master properties(parent:Null). they hasn't any specified values. the value is a dynamic text ";
            $table->string('guide_text')->nullable();
            $table->smallInteger('prop_order')->unsigned()->default('1');
            $table->boolean('prop_status')->default(1)->comment='0:deactive - 1:active';
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
        Schema::dropIfExists('properties');
    }
}

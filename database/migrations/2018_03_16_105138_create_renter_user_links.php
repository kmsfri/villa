<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenterUserLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renter_user_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('renter_user_id')->unsigned();
            $table->foreign('renter_user_id')->references('id')->on('renter_users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('link_key',20)->nullable();
            $table->string('link_url');
            $table->smallInteger('link_order')->unsigned()->default(1);
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
        Schema::dropIfExists('renter_user_links');
    }
}

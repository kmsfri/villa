<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('renter_user_id')->unsigned();
            $table->foreign('renter_user_id')->references('id')->on('renter_users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('villa_title')->default(0);
            $table->string('villa_slug')->unique()->charset('utf8');
            $table->text('villa_description');
            $table->string('villa_short_description',280);
            $table->integer('land_area')->unsigned()->nullable();
            $table->integer('court_area')->unsigned()->nullable();
            $table->integer('building_area')->unsigned()->nullable();
            $table->integer('floor_count')->unsigned()->default(1);
            $table->integer('bedroom_count')->unsigned()->nullable();
            $table->integer('bed_count')->unsigned()->nullable();
            $table->string('sea_distance_by_car',50)->nullable();
            $table->string('sea_distance_walking',50)->nullable();
            $table->integer('standard_capacity')->unsigned()->nullable();
            $table->integer('max_capacity')->unsigned()->nullable();
            $table->integer('foundation_area')->unsigned()->nullable();
            $table->integer('wc_count')->unsigned()->nullable();
            $table->integer('bathroom_count')->unsigned()->nullable();
            $table->string('rent_daily_price_from',20)->nullable();
            $table->string('midweek_price',20)->nullable();
            $table->string('lastweek_price',20)->nullable();
            $table->string('peaktime_price',20)->nullable();
            $table->string('price_description',280);
            $table->boolean('villa_status')->default(0);
            $table->boolean('removed_by_renter')->default(0);
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
        Schema::dropIfExists('villa');
    }
}

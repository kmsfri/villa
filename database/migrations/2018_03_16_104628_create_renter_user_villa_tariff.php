<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenterUserVillaTariff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renter_user_villa_tariff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('renter_user_id')->unsigned();
            $table->foreign('renter_user_id')->references('id')->on('renter_users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('villa_id')->unsigned()->nullable();
            $table->foreign('villa_id')->references('id')->on('villa')->onDelete('set null')->onUpdate('cascade');
            $table->integer('tariff_id')->unsigned()->nullable();
            $table->foreign('tariff_id')->references('id')->on('tariffs')->onDelete('set null')->onUpdate('cascade');
            $table->boolean('paid_status')->default(0)->comment='1:paid';
            $table->string('paid_amount',50)->nullable();
            $table->string('pay_auth_code',50)->nullable();
            $table->timestamp('pay_time')->nullable();
            $table->string('card_number',50)->nullable();
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
        Schema::dropIfExists('renter_user_villa_tariff');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRouteUri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_route_uri', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_route_id')->unsigned();
            $table->foreign('admin_route_id')->references('id')->on('admin_routes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('route_uri',100);
            $table->string('route_type',10);
            $table->string('route_description');
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
        Schema::dropIfExists('admin_route_uri');
    }
}

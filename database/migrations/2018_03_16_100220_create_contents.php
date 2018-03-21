<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content_body');
            $table->string('content_title');
            $table->string('content_slug')->unique()->charset('utf8');
            $table->string('content_tags');
            $table->SmallInteger('content_order')->unsigned()->default(1);
            $table->SmallInteger('show_in_body')->unsigned()->default(0);
            $table->integer('admin_user_id')->unsigned()->nullable();
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('renter_user_id')->unsigned()->nullable();
            $table->foreign('renter_user_id')->references('id')->on('renter_users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('content_status')->default(0)->comment='0:disable - 1:active';
            $table->integer('view_count')->unsigned()->default(0);
            $table->string('longitude',50)->nullable();
            $table->string('latitude',50)->nullable();
            $table->boolean('is_draft')->default(0);
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
        Schema::dropIfExists('contents');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenterUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renter_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile_number',15)->unique();
            $table->string('password');
            $table->string('fullname')->nullable();
            $table->string('avatar_dir')->nullable();
            $table->string('address',500)->nullable();
            $table->string('blog_title')->nullable();
            $table->text('blog_description')->nullable();
            $table->boolean('user_status')->default(1)->comment='0:disable - 1:active';
            $table->string('profile_slug')->unique()->charset('utf8')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('telegram_link')->nullable();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('renter_users');
    }
}

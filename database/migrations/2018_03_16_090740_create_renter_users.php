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
            $table->string('fullname');
            $table->string('avatar_dir');
            $table->string('address',500);
            $table->string('blog_title');
            $table->text('blog_description');
            $table->boolean('user_status')->default(1)->comment='0:disable - 1:active';
            $table->string('profile_slug')->unique()->charset('utf8');
            $table->rememberToken();
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

<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(App\Models\RenterUser::class, function (Faker $faker) {
    return [
        'mobile_number' => $faker->unique()->e164PhoneNumber,
        'password' => bcrypt('1111'),
        'fullname' => $faker->unique()->name(),
        'avatar_dir'=>'tmp/'.$faker->image(public_path().'\tmp',150,150,'cats',false,true),
        'address' => $faker->address,
        'blog_title' => $faker->realText(140),
        'blog_description' => $faker->paragraph,
        'profile_slug' => $faker->unique()->slug(),
        'instagram_link' => $faker->url(),
        'telegram_link' => $faker->url(),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Villa::class, function (Faker $faker) {
    return [
        'renter_user_id' => App\Models\RenterUser::all(['id'])->random(),
        'villa_title'=>$faker->realText(140),
        'villa_slug' => $faker->unique()->slug(),
        'villa_description' => $faker->paragraph,
        'villa_short_description' => $faker->text(230),
        'land_area'=>$faker->numberBetween(100,2000),
        'court_area'=>$faker->numberBetween(500,2000),
        'building_area'=>$faker->numberBetween(200,500),
        'floor_count'=>$faker->numberBetween(1,10),
        'bedroom_count'=>$faker->numberBetween(1,5),
        'bed_count'=>$faker->numberBetween(4,20),
        'sea_distance_by_car'=>$faker->numberBetween(100,10000).' meter',
        'sea_distance_walking'=>$faker->numberBetween(100,10000).' minutes',
        'standard_capacity'=>$faker->numberBetween(10,50),
        'max_capacity'=>$faker->numberBetween(40,100),
        'foundation_area'=>$faker->numberBetween(1000,3000),
        'wc_count'=>$faker->numberBetween(1,10),
        'bathroom_count'=>$faker->numberBetween(1,10),
        'rent_daily_price_from'=>$faker->numberBetween(100000,20000000),
        'midweek_price'=>$faker->numberBetween(100000,20000000),
        'lastweek_price'=>$faker->numberBetween(100000,20000000),
        'peaktime_price'=>$faker->numberBetween(100000,20000000),
        'price_description'=>$faker->text(255),
        'villa_status'=>1,
    ];
});




$factory->define(App\Models\VillaImage::class, function (Faker $faker) {
    return [
        'villa_id' => App\Models\Villa::all(['id'])->random(),
        'image_dir' => 'tmp/'.$faker->image(public_path().'\tmp',755,412,'cats',false,true),
        'image_order'=>$faker->numberBetween(1,10),
    ];
});



/*
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
*/

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\Models\RenterUser::class, 3)->create();
        factory(\App\Models\Villa::class, 15)->create();
        factory(\App\Models\VillaImage::class, 200)->create();

    }
}

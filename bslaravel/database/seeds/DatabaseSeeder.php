<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BandsTableSeeder::class);
         $this->call(ShipsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(GamesTableSeeder::class);
    }
}

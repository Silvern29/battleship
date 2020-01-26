<?php

use App\Game;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();
        Game::create(array(
            'id' => 1
        ));
    }
}

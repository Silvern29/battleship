<?php

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
        $json = File::get("database/data-sample/games.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Game::create(array(
                'id' => $obj->id,
                ));
//                ->fields()->saveMany($obj->fields);
        }
    }
}

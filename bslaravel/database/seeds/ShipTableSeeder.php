<?php

use App\Game;
use App\Ship;
use App\User;
use Illuminate\Database\Seeder;

class ShipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ship')->delete();
        $json = File::get("database/data-sample/ships.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            Ship::create(array(
                'id' => $obj->id,
                'name' => $obj->name,
                'size' => $obj->size,
                'direction' => $obj->direction,
                'coo' => $obj->coo,
                'hits' => $obj->hits,
                'sunk' => $obj->sunk,
            ))
                ->user()->associate(User::find($obj->user))->save()
                ->game()->associate(Game::find($obj->game))->save();
        }
    }
}

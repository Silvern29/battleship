<?php

use App\Field;
use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields')->delete();
        Field::create(array(
            'id' => '1',
            'user_id' => '1',
            'game_id' => '1'
        ))->setField()->save();
//            ->user()->associate(User::find(1))
//            ->game()->associate(Game::find(1))->save();
        Field::create(array(
            'id' => '2',
            'user_id' => '2',
            'game_id' => '1'
        ))->setField()->save();
//            ->user()->associate(User::find(2))
//            ->game()->associate(Game::find(1))->save();
    }
}

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
        ));

        Field::create(array(
            'id' => '2',
            'user_id' => '2',
            'game_id' => '1'
        ));
    }
}

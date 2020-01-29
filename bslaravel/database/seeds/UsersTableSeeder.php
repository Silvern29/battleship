<?php

use App\Ship;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['id' => 1, 'name' => 'evilNonPlayerCharacter', 'email' => 'evil@npc.com', 'password' => Hash::make('66666666')]);
        User::create(['name' => 'Florian', 'email' => 'florian@redlinghaus.at', 'email_verified_at' => now(), 'password' => Hash::make('12345678'), 'remember_token' => Str::random(10)]);

        factory(App\User::class, 2)->create()->each(function($p){$p->save();
        });

    }
}

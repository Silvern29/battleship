<?php

namespace App\Http\Controllers;

use App\Game;
use App\Ship;
use App\User;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function checkHit($ship, $shot): bool
    {
        if(in_array($shot, $ship->coo)){
            $ship->hits++;
            if ($ship->hits === $ship->size){
                $ship->sunk = true;
            }
            $ship->save();
            return true;
        }
        return false;
    }

    public static function createShips(User $user, Game $game)
    {
        $userShips[] = Ship::create(['name' => 'Battleship', 'size' => 5, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Cruiser', 'size' => 4, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Cruiser', 'size' => 4, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Destroyer', 'size' => 3, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Destroyer', 'size' => 3, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Destroyer', 'size' => 3, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Submarine', 'size' => 2, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Submarine', 'size' => 2, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Submarine', 'size' => 2, 'user_id' => $user->id, 'game_id' => $game->id]);
        $userShips[] = Ship::create(['name' => 'Submarine', 'size' => 2, 'user_id' => $user->id, 'game_id' => $game->id]);

//    return Ship::where('user_id', '=', $user->id)
//        ->where('game_id', '=', $game->id)
//        ->get();
        return $userShips;
    }
}

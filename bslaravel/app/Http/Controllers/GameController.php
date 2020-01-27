<?php

namespace App\Http\Controllers;

use App\Game;
use App\Ship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function playAction()
    {
        if(session('game') === null){
            $game = Game::create();
            session(['game' => $game->id]);
            $user = User::find(Auth::id());
            $this->createShips($user, $game);
        }

        return view('pages.game', ['user' => $user, 'game' => $game, 'ships' => $user->ships->where('game_id', '=', $game->id)]);
    }

    public function shotAction()
    {

    }

    public function createShips(User $user, Game $game)
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

        return Ship::where('user_id', '=', $user->id)
            ->where('game_id', '=', $game->id)
            ->get();
    }
}

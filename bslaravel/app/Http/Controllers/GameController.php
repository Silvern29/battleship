<?php

namespace App\Http\Controllers;

use App\Field;
use App\Game;
use App\Ship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    protected $fieldController;
    protected $shipController;

    public function __construct(ShipController $shipController, FieldController $fieldController)
    {
        $this->fieldController = $fieldController;
        $this->shipController = $shipController;
    }

    public function createGame()
    {
        $game = Game::create();
        session(['game' => $game->id]);
        $user = User::find(Auth::id());
        $user->games()->saveMany([$game]);
        $ships = $this->shipController->createShips($user, $game);
        $field = Field::create(['user_id' => $user->id, 'game_id' => $game->id]);
        $this->fieldController->placeShips($field, $ships);
        return redirect('/play');
    }

    public function playAction()
    {
        $game = Game::find(session('game'));
        $user = User::find(Auth::id());
        $ships = $user->ships->where('game_id', '=', $game->id);
        $field = $user->fields->where('game_id', '=', $game->id);

        return view('pages.game', ['user' => $user, 'game' => $game, 'ships' => $ships, 'field' => $field]);
    }

    public function shotAction(Request $request)
    {
        $shot = $request->col . $request->row;
    }


}

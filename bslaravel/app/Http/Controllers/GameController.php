<?php

namespace App\Http\Controllers;

use App\Field;
use App\Game;
use App\NPC;
use App\Ship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    protected $fieldController;
    protected $shipController;
    protected $npcController;

    private $npc;
    private $user;
    private $game;

    public function __construct(ShipController $shipController, NPCController $npcController, FieldController $fieldController)
    {
        $this->fieldController = $fieldController;
        $this->shipController = $shipController;
        $this->npcController = $npcController;
    }

    public function createGame()
    {
        $this->game = Game::create();
        session(['game' => $this->game->id]);
        $this->npc = new NPC($this->game, $this->shipController, $this->npcController, $this->fieldController);
        $this->user = User::find(Auth::id());
        $this->user->games()->saveMany([$this->game]);
        $ships = $this->shipController->createShips($this->user, $this->game);
        $field = Field::create(['user_id' => $this->user->id, 'game_id' => $this->game->id]);
        $this->fieldController->placeShips($field, $ships);
        session(['ships_sunk' => 0]);
        return redirect('/play');
    }

    public function playAction()
    {
        $this->game = Game::find(session('game'));
        $this->user = User::find(Auth::id());
        $ships = $this->user->ships->where('game_id', '=', $this->game->id);
        $field = $this->user->fields->where('game_id', '=', $this->game->id);

        return view('pages.game', ['user' => $this->user, 'game' => $this->game, 'ships' => $ships, 'field' => $field]);
    }

    public function shotAction(Request $request)
    {
        $shot = $request->col . $request->row;
        $user = User::find($request->user);

        $hit = false;
        $message = 'Miss!';

        $shipsSunk = session('ships_sunk');
        $totalShips = count($user->ships);

        foreach ($user->ships as $ship){
            if($this->shipController->checkHit($ship, $shot)){
                $hit = true;
                $message = 'Hit! ';

                if ($ship->sunk) {
                    $message = 'Ship ' . $ship->name . ' sunk!';
                    $shipsSunk++;
                    session(['ships_sunk' => $shipsSunk]);
                }
            }
        }

        if ($totalShips == $shipsSunk) {
            $message = 'GAME OVER!';
        }

        return response()->json(['hit' => $hit, 'message' => $message]);
    }

}

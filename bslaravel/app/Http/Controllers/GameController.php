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

    private $game;
    private $user;
    private $npc;
    private $uField;
    private $ships;

    public function __construct(ShipController $shipController, NPCController $npcController, FieldController $fieldController)
    {
        $this->fieldController = $fieldController;
        $this->shipController = $shipController;
        $this->npcController = $npcController;
    }

    public function createGame()
    {
        $this->game = Game::create();

        $this->npc = new NPC();
        $this->npc->createNPC($this->game);

        $this->user = User::find(Auth::id());
        $this->user->games()->saveMany([$this->game]);

        $ships = $this->shipController->createShips($this->user, $this->game);

        $this->uField = Field::create(['user_id' => $this->user->id, 'game_id' => $this->game->id]);
        $this->fieldController->placeShips($this->uField, $ships);

        session([
            'game' => $this->game->id,
            'ships_sunk' => 0,
            'user' => $this->user->id,
            'uField' => $this->uField->id,
            'nField' => $this->npc->field->id
        ]);

        return redirect('/play');
    }

    public function init(){
        $this->game = Game::find(session('game'));
        $this->npc = new NPC();
        $this->npc->initialiseNPC($this->game);
        $this->user = User::find(session('user'));
        $this->ships = $this->user->ships
            ->where('game_id', '=', $this->game->id)
            ->where('user_id', '=', $this->user->id);
        $this->uField = Field::find(session('uField'));
    }

    public function playAction()
    {
        $this->init();
        return view(
            'pages.game',
            [
                'npcUser' => $this->npc->user,
                'user' => $this->user,
                'game' => $this->game,
                'ships' => $this->ships,
                'uField' => $this->uField->squares,
                'nField' => $this->npc->field->squares,
            ]);
    }

    public function shotAction(Request $request)
    {
        $shot = $request->col . $request->row;

        $this->init();

        $hit = false;
        $message = 'Miss!';
        $npcHits = false;

        $shipsSunk = session('ships_sunk');
        $totalShips = count($this->npc->ships);

        foreach ($this->npc->ships as $ship){
            if($this->shipController->checkHit($ship, $shot)){
                $hit = true;
                $message = 'Hit! ';
                $npcField = $this->npc->field;
                $npcField->squares[$request->col][$request->row] = 'X';
                $npcField->save();

                if ($ship->sunk) {
                    $message = 'Ship ' . $ship->name . ' sunk!';
                    $shipsSunk++;
                    session(['ships_sunk' => $shipsSunk]);
                }
            }
        }

        $col = 'A';
        $row = 1;

        if ($totalShips == $shipsSunk) {
            $message = 'GAME OVER!';
        } else {
            $npcShooting = $this->npcController->npcShot($this->uField);
            $message .= ' ' . $npcShooting['msg'];
            $npcHits = $npcShooting['npcHits'];
            $col = $npcShooting['col'];
            $row = $npcShooting['row'];
        }

        return response()->json(['hit' => $hit, 'npcHits' => $npcHits, 'message' => $message, 'col' => $col, 'row' => $row]);
    }

}

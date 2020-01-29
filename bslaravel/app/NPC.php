<?php

namespace App;

use App\Http\Controllers\FieldController;
use App\Http\Controllers\NPCController;
use App\Http\Controllers\ShipController;
use Illuminate\Database\Eloquent\Model;

class NPC extends Model
{
    private $game;
    private $user;
    private $field;
    private $ships;

    private $npcController;
    private $shipController;
    private $fieldController;

    public function __construct(Game $game, ShipController $shipController, NPCController $npcController, FieldController $fieldController, array $attributes = [])
    {
        parent::__construct($attributes);

        $this->npcController = $npcController;
        $this->shipController = $shipController;
        $this->fieldController = $fieldController;

        $this->game = $game;
        $this->user = User::find(1);
        $this->ships = $shipController->createShips($this->user, $this->game);
        $this->field = Field::create(['game_id' => $this->game->id, 'user_id' => $this->user->id]);
        $this->game->users()->attach([$this->user->id]);
    }
}

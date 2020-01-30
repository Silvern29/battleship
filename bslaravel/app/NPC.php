<?php

namespace App;

use App\Http\Controllers\FieldController;
use App\Http\Controllers\ShipController;
use Illuminate\Database\Eloquent\Model;

class NPC extends Model
{
    private $game;
    private $user;
    private $field;
    private $ships;



    public function createNPC(Game $game){
        $this->game = $game;
        $this->user = User::find(1);
        $this->field = Field::create(['game_id' => $this->game->id, 'user_id' => $this->user->id]);
        $shipController = new ShipController();
        $fieldController = new FieldController();
        $this->ships = $shipController->createShips($this->user, $this->game);
        $fieldController->placeShips($this->field, $this->ships);
        $this->game->users()->attach([$this->user->id]);

    }

    public function initialiseNPC(Game $game){
        $this->game = $game;
        $this->user = User::find(1);
        $this->ships = Ship::where('game_id', '=', $this->game->id)
            ->where('user_id', '=', $this->user->id)
            ->get();

        $this->field = Field::where('game_id', '=', $this->game->id)
            ->where('user_id', '=', $this->user->id)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     */
    public function setGame($game): void
    {
        $this->game = $game;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     */
    public function setField($field): void
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getShips()
    {
        return $this->ships;
    }

    /**
     * @param mixed $ships
     */
    public function setShips($ships): void
    {
        $this->ships = $ships;
    }


}

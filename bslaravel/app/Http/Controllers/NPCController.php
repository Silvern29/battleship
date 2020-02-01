<?php

namespace App\Http\Controllers;

use App\Field;
use App\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NPCController extends Controller
{
    protected $fieldController;
    protected $shipController;
    private $game;

    public function __construct(ShipController $shipController, FieldController $fieldController)
    {
        $this->fieldController = $fieldController;
        $this->shipController = $shipController;
    }

    public function npcShot(Field $field){
        $col = range('A', 'J')[rand(0,9)];
        $row = rand(1,10);
        $target = $field->squares[$col][$row];
        $userField = $field->squares;

        if($target === " " || $target === "X"){
            $this->npcShot($field);
        }

        $msg = "NPC missed!";
        $npcHits = false;

        if ($target != "~") {
            $npcHits = true;
            $msg = 'NPC hit!';
            /*$ship = Ship::find($target);
            $ship->hits++;
            if($ship->hits >= $ship->size){
                $ship->sunk = true;
                $msg = 'Your ' . $ship->name . ' sunk!';
            }
            $ship->save();*/
            $userField[$col][$row] = 'X';
        } else {
            $userField[$col][$row] = ' ';
        }

        $field->squares = $userField;
        $field->save();

        return ['msg' => $msg, 'npcHits' => $npcHits, 'col' => $col, 'row' => $row];
    }
}

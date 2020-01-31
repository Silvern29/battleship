<?php

namespace App\Http\Controllers;

use App\Field;
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
        $userField = $field;

        if($target === " " || $target === "X"){
            $this->npcShot($field);
        }

        $msg = "NPC missed!";
        $npcHits = false;

        if ($target != "~") {
            $userField->squares[$col][$row] = 'X';
            $npcHits = true;
            $msg = 'NPC hit!';
        } else {
            $target = ' ';
        }

        $field->update();

        return ['msg' => $msg, 'npcHits' => $npcHits, 'col' => $col, 'row' => $row];
    }
}

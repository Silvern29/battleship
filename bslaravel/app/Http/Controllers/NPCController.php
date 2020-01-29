<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}

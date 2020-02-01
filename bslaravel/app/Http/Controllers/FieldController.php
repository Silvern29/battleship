<?php

namespace App\Http\Controllers;

use App\Field;
use App\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FieldController extends Controller
{
    public function checkFields($field, Ship $ship){
        $coo = [];

        if($ship->direction === 0){
            $col = rand(1,10 - $ship->size);
            $row = rand(1,10);
            for($i = 0; $i < $ship->size; $i++){
                if($field->squares[$field->getLetters()[$col + $i]][$row] != '~'){
                    $this->checkFields($field, $ship);
                }
                $coo[] = $field->getLetters()[$col + $i] . $row;
            }
        } else {
            $col = rand(1,10);
            $row = rand(1,10 - $ship->size);
            for($i = 0; $i < $ship->size; $i++){
                if($field->squares[$field->getLetters()[$col]][$row + $i] != '~'){
                    $this->checkFields($field, $ship);
                }
                $coo[] = $field->getLetters()[$col] . ($row + $i);
            }
        }

        return $coo;
    }

    public function setShipCoo(Field $field, Ship $ship){
        $field = Field::find($field->id);

        $coo = $this->checkFields($field, $ship);

        $ship->coo = $coo;
        $ship->save();

        $squ = $field->squares;
        foreach ($coo as $co){
            $col = substr($co, 0, 1);
            $row = substr($co, 1);
            $squ[$col][$row] = $ship->id;
        }
        $field->squares = $squ;
        $field->save();
    }

    public function placeShips(Field $field, array $ships){
        foreach($ships as $ship){
            $this->setShipCoo($field, $ship);
        }
    }
}

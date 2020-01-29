<?php

namespace App\Http\Controllers;

use App\Field;
use App\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FieldController extends Controller
{
    public function checkFields(Field $field, Ship $ship){
        $col = substr($ship->coo[0], 0, 1);
        $row = substr($ship->coo[0], 1);
        $coo = [];

        if($ship->direction === 0){
            for($i = 0; $i <= $ship->size; $i++){
                if($field->squares[$field->getletters[$col + $i]][$row] != '~'){
                    return false;
                }
                $coo[] = $field->getLetters[$col + $i] . [$row];
            }
        } else {
            for($i = 0; $i <= $ship->size; $i++){
                if($field->squares[$field->getLetters[$col]][$row + $i] != '~'){
                    return false;
                }
                $coo[] = $field->getLetters[$col] . [$row + $i];
            }
        }
        return $coo;
    }

    public function setShipCoo(Field $field, Ship $ship){
        $coo = $this->checkFields($field, $ship);
        while($coo === false){
            $ship->coo->save(range("A", "J")[rand(0, 9)] . rand(1, 10));
            $this->setShipCoo($field, $ship);
        }
        $squ = $field->squares;
        $shipCoo = $ship->coo;
        foreach ($coo as $co){
            $col = substr($co, 0, 1);
            $row = substr($co, 1);
            $squ[$col][$row] = $ship->id;
            $shipCoo[] = $co;
        }
        $field->squares->save($squ);
        $ship->coo->save($shipCoo);
    }

    public function placeShips(Field $field, array $ships){
        foreach($ships as $ship){
            $this->setShipCoo($field, $ship);
        }
    }
}

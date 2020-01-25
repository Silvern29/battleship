<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battleship extends Ship
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('Battleship', 5, $attributes);
    }
}

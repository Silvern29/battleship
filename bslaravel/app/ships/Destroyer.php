<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destroyer extends Ship
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('Destroyer',3, $attributes);
    }
}

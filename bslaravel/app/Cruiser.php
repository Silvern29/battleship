<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cruiser extends Ship
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('Cruiser', 4, $attributes);
    }
}

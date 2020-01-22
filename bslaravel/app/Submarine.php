<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submarine extends Ship
{
    public function __construct(array $attributes = [])
    {
        parent::__construct('Submarine', 2, $attributes);
    }
}

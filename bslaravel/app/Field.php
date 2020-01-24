<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    private $squares = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setSquares();
    }

    /**
     * Tell Laravel to cast $coo to JSON automatically when saving in DB.
     */
    protected $casts = [
        'squares' => 'array',
    ];

    public function setSquares(): void {
        for($i = 1; $i < 10; $i++){
            for($j = 1; $j < 10; $j++){
                $squares[$i][$j] = '~';
            }
        }
    }
}

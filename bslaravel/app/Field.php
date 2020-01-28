<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    private $letters;

    protected $fillable = [
        'game_id',
        'user_id',
        'squares'
    ];

    protected $attributes = [
        'squares' => ""
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setField();
        $this->setLetters();
    }

    /**
     * Tell Laravel to cast $coo to JSON automatically when saving in DB.
     */
    protected $casts = [
        'squares' => 'array',
    ];

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setField(): Field {
        $field = [];
        for($i = 1; $i < 10; $i++){
            for($j = 1; $j <= 10; $j++){
                $field[$i][$j] = '~';
            }
        }
        $this->squares = $field;
        return $this;
    }

    public function setLetters(){
        $letters = range('A', 'J');
        $this->letters = array_combine(range(1, count($letters)), array_values($letters));
    }
}

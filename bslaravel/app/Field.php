<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'game',
        'user',
        'squares'
    ];

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
            for($j = 1; $j < 10; $j++){
                $field[$i][$j] = '~';
            }
        }
        $this->squares = $field;
        return $this;
    }
}

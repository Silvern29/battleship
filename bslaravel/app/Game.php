<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Relationship methods:
     */
    public function fields(){
        return $this->hasMany(Field::class);
    }

    public function ships(){
        return $this->hasMany(Ship::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

}

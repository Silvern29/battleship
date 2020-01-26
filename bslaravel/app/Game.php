<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Relationship methods:
     */
    public function fields(){
        return $this->hasMany('App\Field');
    }

    public function ships(){
        return $this->hasMany('App\Ship');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    private $fields;
    private $users;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Relationship methods:
     */
    public function fields(){
        $this->hasMany('App\Field');
    }

    public function users(){
        $this->belongsToMany('App\User');
    }

}

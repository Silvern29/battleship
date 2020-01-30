<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'size',
        'direction',
        'coo',
        'user_id',
        'game_id',
        'hits',
        'sunk',
    ];

    protected $attributes = [
        'direction' => 0,
        'hits' => 0,
        'sunk' => false,
//        'coo' => [],
    ];

    /**
     * Tell Laravel to cast $coo to JSON automatically when saving in DB.
     */
    protected $casts = [
        'coo' => 'array',
    ];

    public function __construct(array $attributes = [])
    {

        $this->setRawAttributes(
            array_merge(
                $this->attributes,
                [
                    'direction' => rand(0, 1)
                ]
            ));

        parent::__construct($attributes);
    }

    /**
     * Relationship methods:
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function setRndStart(){
        $this->coo = array(range("A", "J")[rand(0, 9)] . rand(1, 10));
        return $this->coo;
    }


}

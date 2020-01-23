<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $table = 'ship';
    protected $primaryKey = 'id';
    protected $increment = true;

    protected $name;
    protected $size;
    protected $direction;
    protected $coo;
    protected $hits = 0;
    protected $sunk = false;

    protected $user;
    protected $game;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->direction = rand(0,1);
    }

    /**
     * Tell Laravel to cast $coo to JSON automatically when saving in DB.
     */
    protected $casts = [
        'coo' => 'array',
    ];

    /**
     * Relationship methods:
     */

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function game(){
        return $this->belongsTo('App\Game');
    }

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getDirection(): int
    {
        return $this->direction;
    }

    /**
     * @param int $direction
     */
    public function setDirection(int $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @return array
     */
    public function getCoo(): array
    {
        return $this->coo;
    }

    /**
     * @param array $coo
     */
    public function setCoo(array $coo): void
    {
        $this->coo = $coo;
    }

    /**
     * @return int
     */
    public function getHits(): int
    {
        return $this->hits;
    }

    /**
     * @param int $hits
     */
    public function setHits(int $hits): void
    {
        $this->hits = $hits;
    }

    /**
     * @return bool
     */
    public function isSunk(): bool
    {
        return $this->sunk;
    }

    /**
     * @param bool $sunk
     */
    public function setSunk(bool $sunk): void
    {
        $this->sunk = $sunk;
    }
}

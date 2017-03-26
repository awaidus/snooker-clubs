<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['club_name', 'club_address', 'no_of_tables', 'manager_id'];

    public function tables()
    {
        return $this->hasMany(GameTable::class);
    }

    public function games()
    {
        return $this->hasManyThrough(Game::class, GameTable::class);
    }

}

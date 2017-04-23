<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

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

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Game::class);
    }

    public function manager()
    {
        return $this->hasOne(User::class, 'manager_id');
    }

    public function scopeForManager($query)
    {
        $query->where('manager_id', Sentinel::getUser()->id)->with(['transactions']);
    }

}

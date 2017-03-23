<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['player_name','contact'];

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function bills()
    {
        return $this->hasManyThrough('App\Bill', 'App\Game');
    }

}

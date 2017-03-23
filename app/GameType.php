<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    protected $table = 'game_types';

    protected $fillable = ['game_type', 'price'];

    public function games()
    {
        return $this->hasMany('App\Game');
    }
}

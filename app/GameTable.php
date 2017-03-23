<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameTable extends Model
{
    protected $table = 'game_tables';

    protected $fillable = ['club_id', 'table_no'];

    public function club()
    {
        return $this->belongsTo('App\Club');
    }

    public function games()
    {
        return $this->hasMany('App\Game');
    }


   
}

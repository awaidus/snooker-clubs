<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = true;

    protected $fillable = ['game_table_id', 'game_type_id', 'player_id', 'completed', 'no_of_players', 'user_id',
        'started_at', 'ended_at'];

    //protected $dates = ['started_at', 'ended_at', 'created_at', 'updated_at',];

    protected $events = ['created' => Events\GameCreated::class];

//    protected $casts = [
//        'completed' => 'boolean',
//    ];

    public function table()
    {
        return $this->belongsTo(GameTable::class, 'game_table_id');
    }


    public function bill()
    {
        return $this->hasOne(Bill::class);
    }

    public function game_type()
    {
        return $this->belongsTo(GameType::class, 'game_type_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function scopeActivate($query)
    {
        $query->where('completed', '=', 0);
    }



    public function getStartedAtAttribute($date)
    {
        if (!is_null($date)) {
            return Carbon::parse($date);
        }
    }

    public function getEndedAtAttribute($date)
    {
        if (!is_null($date)) {
            return Carbon::parse($date);
//            return Carbon::createFromFormat('Y-m-d H:i:s', $date);
//          return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i A');
            // return Carbon::parse($date);

        }
    }


    public function setStartedAtAttribute($date)
    {
        if (is_string($date))
            $this->attributes['started_at'] = Carbon::parse($date);
    }

    public function setEndedAtAttribute($date)
    {
        if (is_string($date))
            $this->attributes['ended_at'] = Carbon::parse($date);
    }

    public function getCompletedAttribute($completed)
    {
        return (bool) $completed;
    }

    public function setCompletedAttribute($completed)
    {
        $this->attributes['completed'] = (bool) $completed;
    }

//    public function setCompletedAttribute($value)
//    {
//        if ( ! isset($value) )
//            $this->attributes['completed'] = 0;

//    }
}

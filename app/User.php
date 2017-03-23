<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;

class User extends SentinelUser {

    protected $fillable = [
        'email',
        'username',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    protected $loginNames = ['username'];

}
<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;
use Sentinel;

class User extends SentinelUser
{

    protected $fillable = [
        'email',
        'username',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    protected $loginNames = ['username'];

    public function isSuperAdmin()
    {
        return ((Sentinel::check() && (Sentinel::inRole('super'))));
    }

    public function isAdmin()
    {
        return ((Sentinel::check() && (Sentinel::inRole('admin'))));
    }

    public function isSuperAdminOrAdmin()
    {
        return ((Sentinel::check() && (Sentinel::inRole('super') || Sentinel::inRole('admin'))));
    }

    public function isManager()
    {
        return ((Sentinel::check() && (Sentinel::inRole('manager'))));
    }



}
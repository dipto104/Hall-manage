<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provost extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'userid', 'password','emailid',
    ];

    /**
     *
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

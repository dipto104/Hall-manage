<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Requestroom extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roomno','roomtype', 'capacity', 'occupy','requesttype'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}

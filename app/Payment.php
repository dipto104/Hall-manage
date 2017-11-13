<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Payment extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'termno','messno','studentid','name','roomno','department','hallscroll','bankscroll','receivedate','remarks', 'due',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}

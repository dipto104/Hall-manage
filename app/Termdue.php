<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Termdue extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'termno','studentid','name','roomno','totalmess','due','remarks',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}

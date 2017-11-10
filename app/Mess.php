<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mess extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'termno','messno', 'startat', 'finishat','vacstartat','vacfinishat','fine',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Notice extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'noticename','noticebody', 'noticeby', 'uniquefilename','givenfilename'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}


<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Requeststudent extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'studentid','name', 'department', 'roomno','studenttype','requesttype'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}

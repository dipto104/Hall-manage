<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Requestroomcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:asstprovost');
    }
}

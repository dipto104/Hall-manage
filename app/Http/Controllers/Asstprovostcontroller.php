<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class AsstprovostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:asstprovost');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('asstprovost');
    }


}

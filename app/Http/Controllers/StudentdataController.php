<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentdataController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showdata()
    {
        $data=User::all();

        return view('foradmin.studentdata',compact('data'));
    }
}

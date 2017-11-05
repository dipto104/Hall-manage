<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public function showinsertstudent()
    {
        return view('foradmin.insertstudent');
    }

    public function insertstudent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $name=$request['name'];
        $email=$request['email'];
        $password=bcrypt($request['password']);

        $student=new User();
        $student->name=$name;
        $student->email=$email;
        $student->password=$password;

        $student->save();



        return redirect()->route('admin.dashboard');

    }

}

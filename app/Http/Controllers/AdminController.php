<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Session;

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
            'studentid' => 'required|numeric|unique:users',
            'department' => 'required|',
            'roomno' => 'required|numeric',
            'userid' => 'required|min:7|numeric|unique:users',
            'password' => 'required|min:7|confirmed'
        ]);

        $name=$request['name'];
        $studentid=$request['studentid'];
        $department=$request['department'];
        $roomno=$request['roomno'];
        $userid=$request['userid'];
        $password=bcrypt($request['password']);

        $student=new User();
        $student->name=$name;
        $student->studentid=$studentid;
        $student->department=$department;
        $student->roomno=$roomno;
        $student->userid=$userid;
        $student->password=$password;

        $student->save();
        Session::flash('success', 'This student data were successfully saved.');



        $data=User::all();

        return view('foradmin.studentdata',compact('data'));

    }

}

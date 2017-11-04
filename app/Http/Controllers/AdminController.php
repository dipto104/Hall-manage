<?php

namespace App\Http\Controllers;

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
            'studentid' => 'required|unique:students',
            'firstname' => 'required',
            'lastname' => 'required|'
        ]);

        $studentid=$request['studentid'];
        $firstname=$request['firstname'];
        $lastname=$request['lastname'];

        $student=new Student();
        $student->studentid=$studentid;
        $student->firstname=$firstname;
        $student->lastname=$lastname;

        $student->save();



        return redirect()->route('dashboard');

    }

}

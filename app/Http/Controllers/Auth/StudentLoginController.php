<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class StudentLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest',['except' => ['studentlogout']]);
    }

    public function showloginform()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|',
            'password' => 'required|'
        ]);


        if (Auth::guard('web')->attempt(['userid' => $request['userid'], 'password' => $request['password']])) {
            return redirect()->route('student.dashboard');
        }
        Session::flash('danger', 'User ID or Password is incorrect.');


        return redirect()->back()->withInput($request->only('userid', 'remember'));

    }
    public function studentlogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
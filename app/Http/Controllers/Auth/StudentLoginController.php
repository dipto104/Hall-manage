<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
            'email' => 'required|',
            'password' => 'required|'
        ]);


        if (Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('student.dashboard');
        }


        return redirect()->back()->withInput($request->only('email', 'remember'));

    }
    public function studentlogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
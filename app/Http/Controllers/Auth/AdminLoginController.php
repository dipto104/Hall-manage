<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin',['except' => ['adminlogout']]);
    }


    public function showloginform()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|',
            'password' => 'required|'
        ]);


        if (Auth::guard('admin')->attempt(['userid' => $request['userid'], 'password' => $request['password']])) {
            return redirect()->route('admin.dashboard');
        }


        return redirect()->back()->withInput($request->only('userid', 'remember'));

    }
    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
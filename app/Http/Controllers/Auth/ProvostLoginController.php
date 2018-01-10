<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;

class ProvostLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:provost',['except' => ['provostlogout']]);
    }


    public function showloginform()
    {
        return view('auth.provost-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|',
            'password' => 'required|'
        ]);


        if (Auth::guard('provost')->attempt(['userid' => $request['userid'], 'password' => $request['password']],$request->remember)) {
            $data= DB::select('select * from admins');
            $admin=Admin::find($data[0]->id);
            Auth::guard('admin')->login($admin);
            //logging to provost both as admin and provost role
            return redirect()->route('provost.dashboard');
        }

        Session::flash('danger', 'User ID or Password is incorrect.');


        return redirect()->back()->withInput($request->only('userid', 'remember'));

    }
    public function provostlogout()
    {
        Auth::guard('provost')->logout();
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
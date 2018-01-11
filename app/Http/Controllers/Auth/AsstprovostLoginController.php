<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;

class AsstprovostLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:asstprovost',['except' => ['asstprovostlogout']]);
    }


    public function showloginform()
    {
        return view('auth.asstprovost-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|',
            'password' => 'required|'
        ]);


        if (Auth::guard('asstprovost')->attempt(['userid' => $request['userid'], 'password' => $request['password']],$request->remember)) {
            $data= DB::select('select * from admins');
            $admin=Admin::find($data[0]->id);
            Auth::guard('admin')->login($admin);
            //logging to provost both as admin and provost role
            return redirect()->route('asstprovost.dashboard');
        }

        Session::flash('danger', 'User ID or Password is incorrect.');


        return redirect()->back()->withInput($request->only('userid', 'remember'));

    }
    public function asstprovostlogout()
    {
        Auth::guard('asstprovost')->logout();
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Room;
use App\Admin;
use App\Provost;
use App\Asstprovost;
use App\Requeststudent;
use App\Requestroom;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Alllogincontroller extends Controller
{
    //
    public $data=null;
    public function __construct()
    {
        $this->middleware('guest',['except' => ['logout']]);
    }


    public function showloginform()
    {
        return view('auth.alllogin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|',
            'password' => 'required|'
        ]);
        $pass=bcrypt($request['password']);
        $data= DB::select('select * from allusers where userid = :userid ', ['userid' =>  $request['userid'] ]);
        if($data!=null){
            if($data[0]->guard=='admin') {
                if (Auth::guard('admin')->attempt(['userid' => $request['userid'], 'password' => $request['password']], $request->remember)) {
                    return redirect()->route('admin.dashboard');
                }
                Session::flash('danger', 'User ID or Password is incorrect.');
            }
            else if($data[0]->guard=='web') {
                if (Auth::guard('web')->attempt(['userid' => $request['userid'], 'password' => $request['password']], $request->remember)) {
                    $data= DB::select('select * from users where studentid = :studentid ', ['studentid' => $request['userid']]);

                    return redirect()->route('student.dashboard', $data[0]->id);
                }
                Session::flash('danger', 'User ID or Password is incorrect.');
            }
            else if($data[0]->guard=='provost') {
                if (Auth::guard('provost')->attempt(['userid' => $request['userid'], 'password' => $request['password']], $request->remember)) {
                    return redirect()->route('provost.dashboard');
                }
                Session::flash('danger', 'User ID or Password is incorrect.');
            }
            else if($data[0]->guard=='asstprovost') {
                if (Auth::guard('asstprovost')->attempt(['userid' => $request['userid'], 'password' => $request['password']], $request->remember)) {
                    return redirect()->route('asstprovost.dashboard');
                }
                Session::flash('danger', 'User ID or Password is incorrect.');

            }


        }

        else{
            Session::flash('danger', 'User ID or Password is incorrect.');
        }



        return redirect()->back()->withInput($request->only('userid', 'remember'));

    }
    public function logout()
    {
        if( Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
       elseif (Auth::guard('web')->check()){
           Auth::guard('web')->logout();
       }
        elseif (Auth::guard('provost')->check()){
            Auth::guard('provost')->logout();
        }
        elseif (Auth::guard('asstprovost')->check()){
            Auth::guard('asstprovost')->logout();
        }
        return redirect('/');
    }
}
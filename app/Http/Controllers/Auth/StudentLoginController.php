<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;

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
            $data= DB::select('select * from users where studentid = :studentid ', ['studentid' => $request['userid']]);

                return redirect()->route('student.dashboard', $data[0]->id);

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
<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Admin;
use App\Provost;
use App\Requeststudent;
use App\Requestroom;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProvostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:provost');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provost');
    }
    public function resetpasswordshow()
    {
        return view('forprovost.passwordreset');
    }
    public function resetpassword(Request $request){
        $id=Auth::user()->id;
        $provost= Provost::find($id);
        $this->validate($request, [
            'oldpass' => 'required|',
            'password' => 'required|confirmed',
        ]);

        $oldpass=$request['oldpass'];
        $newpass=$request['password'];
        $variable=Hash::check($oldpass, $provost->password);
        if($variable==false){
            Session::flash('danger', 'Old Password was incorrect.');
            return redirect()->back();
        }
        else{
            $provost->password=bcrypt($newpass);
            $provost->save();

            Session::flash('success', 'Password successfully updated.');
            return redirect()->route('provost.dashboard');
        }


    }


}

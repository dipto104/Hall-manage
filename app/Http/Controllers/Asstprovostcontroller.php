<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Admin;
use App\Provost;
use App\Asstprovost;
use App\Requeststudent;
use App\Requestroom;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AsstprovostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:asstprovost');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('asstprovost');
    }
    public function resetpasswordshow()
    {
        return view('forasstprovost.passwordreset');
    }
    public function resetpassword(Request $request){
        $id=Auth::user()->id;
        $asstprovost= Asstprovost::find($id);
        $this->validate($request, [
            'oldpass' => 'required|',
            'password' => 'required|confirmed',
        ]);

        $oldpass=$request['oldpass'];
        $newpass=$request['password'];
        $variable=Hash::check($oldpass, $asstprovost->password);
        if($variable==false){
            Session::flash('danger', 'Old Password was incorrect.');
            return redirect()->back();
        }
        else{
            $asstprovost->password=bcrypt($newpass);
            $asstprovost->save();

            Session::flash('success', 'Password successfully updated.');
            return redirect()->route('asstprovost.dashboard');
        }


    }


}

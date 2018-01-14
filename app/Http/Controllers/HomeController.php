<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Term;
use App\User;
use App\Mess;
use App\Termdue;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)

    {
        $data= User::find($id);
        if(Auth::user()!=$data){
            return redirect()->back();
        }
        return view('home',compact('data'));
    }
    public function showduestatus($id)
    {
        $student= User::find($id);
        if(Auth::user()!=$student){
            return redirect()->back();
        }
        $data=DB::select('select * from termdues where  studentid = :studentid', ['studentid' => $student->studentid]);
        return view('forstudent.duestatus',compact('data'));
    }
    public function resetpasswordshow()
    {
        return view('forstudent.passwordreset');
    }
    public function resetpassword(Request $request){
        $id=Auth::user()->id;
        $student= User::find($id);
        $this->validate($request, [
            'oldpass' => 'required|',
            'password' => 'required|min:7|confirmed',
        ]);

        $oldpass=$request['oldpass'];
        $newpass=$request['password'];
        $variable=Hash::check($oldpass, $student->password);
        if($variable==false){
             Session::flash('danger', 'Old Password was incorrect.');
             return redirect()->back();
        }
        else{
            $student->password=bcrypt($newpass);
            $student->save();

            Session::flash('success', 'Password successfully updated.');
            return redirect()->route('student.dashboard',$id);
        }


    }
}

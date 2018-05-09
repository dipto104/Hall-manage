<?php

namespace App\Http\Controllers;

use App\Alluser;
use App\User;
use App\Room;
use App\Admin;
use App\Requeststudent;
use App\Requestroom;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public function showinsertstudent()
    {
        return view('foradmin.insertstudent');
    }

    public function insertstudent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'studentid' => 'required|numeric|unique:users',
            'department' => 'required|',
            'roomno' => 'required|numeric',

        ]);

        $name=$request['name'];
        $studentid=$request['studentid'];
        $department=$request['department'];
        $roomno=$request['roomno'];
        $userid=$studentid;
        $password=bcrypt($studentid);
        $reqstudent = DB::select('select * from requeststudents where studentid = :studentid', ['studentid' => $studentid]);
        $reqroom = DB::select('select * from requestrooms where roomno = :roomno', ['roomno' => $roomno]);
        if ($reqstudent == null) {

            if ($reqroom == null) {
                $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $roomno]);
                if ($dataroom == null) {
                    Session::flash('danger', 'Room number is not available.');
                    return redirect()->back()->withInput();
                } else {
                    if ($dataroom[0]->occupy == $dataroom[0]->capacity) {
                        Session::flash('danger', 'No Sit is available in this Room.');
                        return redirect()->back()->withInput();
                    }
                    $data = Room::find($dataroom[0]->id);
                    $data->occupy = $data->occupy + 1;
                    $data->save();
                }
                $student = new User();
                $student->name = $name;
                $student->studentid = $studentid;
                $student->department = $department;
                $student->roomno = $roomno;
                $student->userid = $userid;
                $student->password = $password;


                $alluser = new Alluser();
                $alluser->userid = $userid;
                $alluser->password = $password;
                $alluser->guard = 'web';
                $alluser->save();

                if (!Auth::guard('provost')->check()) {
                    $requeststudent = new Requeststudent();
                    $requeststudent->name = $name;
                    $requeststudent->studentid = $studentid;
                    $requeststudent->department = $department;
                    $requeststudent->roomno = $roomno;
                    $requeststudent->studenttype = "RESIDENT";
                    $requeststudent->requesttype = "INSERT";

                    $student->save();
                    $requeststudent->save();
                    Session::flash('success', 'The INSERT request is sent to Provost Sir.');

                } else {
                    $student->save();
                    Session::flash('success', 'The Student Data is saved.');
                }
                $data = User::all();

                return view('foradmin.studentdata', compact('data'));
            } else {
                Session::flash('danger', 'This Room is not verified yet by the Asst. Provost.');
                return redirect()->back()->withInput();
            }
        }
        else {
            Session::flash('danger', 'The Previous request is in process please wait.');
        }



    }

    public function resetpasswordshow()
    {
        return view('foradmin.passwordreset');
    }
    public function resetpassword(Request $request){
        $id=Auth::user()->id;
        $student= Admin::find($id);
        $this->validate($request, [
            'oldpass' => 'required|',
            'password' => 'required|confirmed',
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
            return redirect()->route('admin.dashboard');
        }


    }

}

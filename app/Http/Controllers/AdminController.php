<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Requeststudent;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

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
            'userid' => 'required|min:7|numeric|unique:users',
            'password' => 'required|min:7|confirmed'
        ]);

        $name=$request['name'];
        $studentid=$request['studentid'];
        $department=$request['department'];
        $roomno=$request['roomno'];
        $userid=$request['userid'];
        $password=bcrypt($request['password']);

        $dataroom=DB::select('select * from rooms where roomno = :roomno',['roomno' => $roomno]);
        if($dataroom==null){
            Session::flash('danger', 'Room number is not available.');
            return redirect()->back()->withInput();
        }
        else{
            if($dataroom[0]->occupy==$dataroom[0]->capacity){
                Session::flash('danger', 'No Sit is available in this Room.');
                return redirect()->back()->withInput();
            }
            $data=Room::find($dataroom[0]->id);
            $data->occupy=$data->occupy+1;
            $data->save();
        }
        $student=new User();
        $student->name=$name;
        $student->studentid=$studentid;
        $student->department=$department;
        $student->roomno=$roomno;
        $student->userid=$userid;
        $student->password=$password;



        $requeststudent=new Requeststudent();
        $requeststudent->name=$name;
        $requeststudent->studentid=$studentid;
        $requeststudent->department=$department;
        $requeststudent->roomno=$roomno;
        $requeststudent->studenttype="RESEDENT";
        $requeststudent->requesttype="INSERT";

        $student->save();
        $requeststudent->save();
        Session::flash('success', 'This student data were successfully saved.');



        $data=User::all();

        return view('foradmin.studentdata',compact('data'));

    }

}

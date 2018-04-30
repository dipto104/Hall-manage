<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attachedstudent;
use App\Requeststudent;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Attachedstudentcontroller extends Controller
{
    //
    public function showinsertattached()
    {
        return view('foradmin.insertstudent');
    }

    public function insertattached(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|',
            'studentid' => 'required|numeric|unique:attachedstudents',
            'department' => 'required|',

        ]);

        $name=$request['name'];
        $studentid=$request['studentid'];
        $department=$request['department'];
        $isresident = DB::select('select * from users where studentid = :studentid', ['studentid' => $studentid]);
        $reqstudent = DB::select('select * from requeststudents where studentid = :studentid', ['studentid' => $studentid]);
        if($isresident == null) {
            if ($reqstudent == null) {
                $student = new Attachedstudent();
                $student->name = $name;
                $student->studentid = $studentid;
                $student->department = $department;

                if (!Auth::guard('provost')->check()) {
                    $requeststudent = new Requeststudent();
                    $requeststudent->name = $name;
                    $requeststudent->studentid = $studentid;
                    $requeststudent->department = $department;
                    $requeststudent->studenttype = "ATTACHED";
                    $requeststudent->requesttype = "INSERT";

                    $student->save();
                    $requeststudent->save();
                    Session::flash('success', 'The INSERT request is sent to Provost Sir.');

                } else {
                    $student->save();
                    Session::flash('success', 'The Student Data is saved.');
                }
                //$data = User::all();

                //return view('foradmin.studentdata', compact('data'));
            } else {
                Session::flash('danger', 'The Previous request is in process please wait.');
            }
        }
        else{
            Session::flash('danger', 'The student is allready an resident student.');
        }



    }
}

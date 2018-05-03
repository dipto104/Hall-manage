<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attachedstudent;
use App\Requeststudent;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Attachedstudentcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showinsertattached()
    {
        return view('foradmin.insertattachedstudent');
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
                return redirect()->route('admin.attacheddata');

                //return view('foradmin.studentdata', compact('data'));
            } else {
                Session::flash('danger', 'The Previous request is in process please wait.');
                return redirect()->back()->withInput();
            }
        }
        else{
            Session::flash('danger', 'The student is allready an resident student.');
            return redirect()->back()->withInput();
        }



    }
    public function showattachedIndex()
    {
        return view('foradmin.attachedstudent');
    }
    public function attachedstudent()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $users= DB::select('select * from attachedstudents');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/perattachedinfo/$user->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function show($id)
    {
        $data=Attachedstudent::find($id);

        return view('foradmin.perattachedinfo',compact('data'));
    }
    public function edit($id)
    {
        $data=Attachedstudent::find($id);

        return view('foradmin.editattached',compact('data'));
    }
    public function update(Request $request,$id )
    {
        $this->validate($request, [
            'name' => 'required|',
            'studentid' => ['required', 'numeric', Rule::unique('attachedstudents')->ignore($id)],
            'department' => 'required|',

        ]);

        $name = $request['name'];
        $studentid = $request['studentid'];
        $department = $request['department'];
        $isresident = DB::select('select * from users where studentid = :studentid', ['studentid' => $studentid]);
        $reqstudent = DB::select('select * from requeststudents where studentid = :studentid', ['studentid' => $studentid]);
        if ($isresident == null) {
            if ($reqstudent == null) {
                $student = Attachedstudent::find($id);
                $student->name = $name;
                $student->studentid = $studentid;
                $student->department = $department;


                $student->save();

                Session::flash('success', 'This data was successfully updated.');
            } else {
                Session::flash('danger', 'The Student data cant be edited now.');
            }


            //$data = User::all();

            return redirect()->route('admin.attacheddata');
        }
    }
    public function destroy($id)
    {
        $data = Attachedstudent::find($id);
        if(!Auth::guard('provost')->check()) {
            $reqstudent = DB::select('select * from requeststudents where studentid = :studentid', ['studentid' => $data->studentid]);
            if ($reqstudent == null) {
                $requeststudent = new Requeststudent();
                $requeststudent->name = $data->name;
                $requeststudent->studentid = $data->studentid;
                $requeststudent->department = $data->department;
                $requeststudent->studenttype = "ATTACHED";
                $requeststudent->requesttype = "DELETE";
                $requeststudent->save();
                Session::flash('success', 'The DELETE request is sent to Provost Sir.');
            } else {
                Session::flash('danger', 'The Previous request is in process please wait.');
            }
        }
        else{

            $data->delete();
            Session::flash('success', 'This Data is successfully deleted.');

        }

        return redirect()->route('admin.attacheddata');
    }


}

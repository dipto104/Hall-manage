<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class StudentdataController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getIndex()
    {
        return view('forstudent.datatable');
    }
    public function anyData()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $users= DB::select('select * from users');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/perstudentinfo/$user->id' class='btn btn-xs btn-primary'></i> View</a>";
            })
            ->make(true);
    }
    public function showdata()
    {
        $data=User::all();

        return view('foradmin.studentdata',compact('data'));
    }
    public function show($id)
    {
        $data=User::find($id);

        return view('foradmin.perstudentinfo',compact('data'));
    }
    public function edit($id)
    {
        $data=User::find($id);

        return view('foradmin.editstudent',compact('data'));
    }
    public function update(Request $request,$id )
    {
        $this->validate($request, [
            'name' => 'required|',
            'studentid' => ['required','numeric',Rule::unique('users')->ignore($id)],
            'department' => 'required|',
            'roomno' => 'required|numeric',
            'userid' => ['required','numeric',Rule::unique('users')->ignore($id)]

        ]);

        $name=$request['name'];
        $studentid=$request['studentid'];
        $department=$request['department'];
        $roomno=$request['roomno'];
        $userid=$request['userid'];


        $student=User::find($id);
        $student->name=$name;
        $student->studentid=$studentid;
        $student->department=$department;
        $student->roomno=$roomno;
        $student->userid=$userid;

        $student->save();
        Session::flash('success', 'This data was successfully updated.');



        $data=User::all();

        return view('foradmin.studentdata',compact('data'));

    }
    public function destroy($id)
    {
        $data = User::find($id);

        $data->delete();

        Session::flash('success', 'The data was successfully deleted.');
        $data=User::all();

        return view('foradmin.studentdata',compact('data'));
    }

}

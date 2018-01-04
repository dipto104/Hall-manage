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
    public function showstudentIndex()
    {
        return view('foradmin.studentdata');
    }
    public function anyData()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $users= DB::select('select * from users');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/perstudentinfo/$user->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function showdata()
    {
        $users= DB::select('select * from users');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/perstudentinfo/$user->id' class='btn btn-xs btn-primary'></i><span class=\"glyphicon glyphicon-folder-open\"></span> OPEN</a>";
            })
            ->make(true);
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
    public function importstudent(Request $request)
    {
        //dd( $request->file('file') );
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt',

        ]);
        if(($handle = fopen($_FILES['file']['tmp_name'],"r"))!=false){
            fgetcsv($handle);
            while (($data=fgetcsv($handle,1000,","))!=false){
                //echo $data[0];
                $name=$data[0];
                $studentid=$data[1];
                $department=$data[2];
                $roomno=$data[3];
                $userid=$studentid;
                $password=bcrypt($studentid);

                $student=new User();
                $student->name=$name;
                $student->studentid=$studentid;
                $student->department=$department;
                $student->roomno=$roomno;
                $student->userid=$userid;
                $student->password=$password;

                $student->save();







            }
        }
        Session::flash('success', 'All students data were successfully saved.');
        $data=User::all();
        return view('foradmin.studentdata',compact('data'));

    }
    public function exportstudent()
    {
        $datas = User::all();
        $student="";
        if(count($datas)>0){
            $student.= '<table>
            <tr>
                <th>Name</th>
                <th>Student ID</th>
                <th>Deaprtment</th>
                <th>Room NO</th>
            </tr>';


        }
        foreach ($datas as $data){
            $student.='
            <tr>
            <td>'.$data->name.'</td>
            <td>'.$data->studentid.'</td>
            <td>'.$data->department.'</td>
            <td>'.$data->roomno.'</td>
            </tr>';
      
        }
        $student.='</table>';
        header('Content_Type: application/xls');
        header('Content-Disposition: atttachment; filename=student.xls');

        echo $student;

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

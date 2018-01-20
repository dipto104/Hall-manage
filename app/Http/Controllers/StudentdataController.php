<?php

namespace App\Http\Controllers;
use App\User;
use App\Room;
use App\Requeststudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        ]);

        $name=$request['name'];
        $studentid=$request['studentid'];
        $department=$request['department'];
        $roomno=$request['roomno'];
        $userid=$request['userid'];
        $reqroom = DB::select('select * from requestrooms where roomno = :roomno', ['roomno' => $roomno]);
        if($reqroom==null) {
            $reqstudent = DB::select('select * from requeststudents where studentid = :studentid', ['studentid' => $studentid]);
            if ($reqstudent == null) {
                $student = User::find($id);
                $student->name = $name;
                $student->studentid = $studentid;
                $student->department = $department;


                if ($student->roomno != $roomno) {
                    $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $roomno]);
                    if ($dataroom == null) {
                        Session::flash('danger', 'Room number is not available.');
                        return redirect()->back()->withInput();
                    } else {
                        if ($dataroom[0]->occupy == $dataroom[0]->capacity) {
                            Session::flash('danger', 'No Sit is available in this Room.');
                            return redirect()->back()->withInput();
                        }
                        //new room added student
                        $data = Room::find($dataroom[0]->id);
                        $data->occupy = $data->occupy + 1;
                        $data->save();


                        //previous room substract student
                        $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $student->roomno]);
                        $data = Room::find($dataroom[0]->id);
                        $data->occupy = $data->occupy - 1;
                        $data->save();
                    }
                }
                $student->roomno = $roomno;
                $student->userid = $studentid;

                $student->save();
                Session::flash('success', 'This data was successfully updated.');
            } else {
                Session::flash('danger', 'The Student data cant be edited now.');
            }


            $data = User::all();

            return view('foradmin.studentdata', compact('data'));
        }
        else{
            Session::flash('danger', 'This Room is not verified yet by the Asst. Provost.');
            return redirect()->back()->withInput();
        }

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

                $reqroom = DB::select('select * from requestrooms where roomno = :roomno', ['roomno' => $roomno]);
                if($reqroom==null) {
                    $datastudent = DB::select('select * from users where studentid = :studentid', ['studentid' => $studentid]);
                    if ($datastudent != null) {
                        Session::flash('danger', "Duplicate student id No : $studentid");
                        return redirect()->back();
                    }
                    $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $roomno]);
                    if ($dataroom == null) {
                        Session::flash('danger', "Room number is not available for student id : $studentid");
                        return redirect()->back();
                    } else {
                        if ($dataroom[0]->occupy == $dataroom[0]->capacity) {
                            Session::flash('danger', "No Sit is available in Room No : $roomno for student id : $studentid");
                            return redirect()->back();
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

                    if (!Auth::guard('provost')->check()) {
                        $requeststudent = new Requeststudent();
                        $requeststudent->name = $name;
                        $requeststudent->studentid = $studentid;
                        $requeststudent->department = $department;
                        $requeststudent->roomno = $roomno;
                        $requeststudent->studenttype = "RESEDENT";
                        $requeststudent->requesttype = "INSERT";

                        $student->save();
                        $requeststudent->save();
                        Session::flash('success', 'All The INSERT request is sent to Provost Sir.');

                    } else {
                        $student->save();
                        Session::flash('success', 'All students data were successfully saved.');
                    }
                }
                else{
                    Session::flash('danger', " Room No :$roomno is not verified yet by the Asst. Provost.");
                    return redirect()->back();
                }









            }
        }
        //Session::flash('success', 'All students data were successfully saved.');
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
        if(!Auth::guard('provost')->check()) {
            $reqstudent = DB::select('select * from requeststudents where studentid = :studentid', ['studentid' => $data->studentid]);
            if ($reqstudent == null) {
                $requeststudent = new Requeststudent();
                $requeststudent->name = $data->name;
                $requeststudent->studentid = $data->studentid;
                $requeststudent->department = $data->department;
                $requeststudent->roomno = $data->roomno;
                $requeststudent->studenttype = "RESEDENT";
                $requeststudent->requesttype = "DELETE";
                $requeststudent->save();
                Session::flash('success', 'The DELETE request is sent to Provost Sir.');
            } else {
                Session::flash('danger', 'The Previous request is in process please wait.');
            }
        }
        else{
            $dataroom=DB::select('select * from rooms where roomno = :roomno',['roomno' => $data->roomno]);
            $room=Room::find($dataroom[0]->id);
            $room->occupy=$room->occupy-1;
            $room->save();
            //room data upadting end


            $data->delete();
            Session::flash('success', 'This Data is successfully deleted.');

        }
        //room purpose room data updating

        /*$dataroom=DB::select('select * from rooms where roomno = :roomno',['roomno' => $data->roomno]);
        $room=Room::find($dataroom[0]->id);
        $room->occupy=$room->occupy-1;
        $room->save();
        //room data upadting end


        $data->delete();*/
        $data=User::all();

        return view('foradmin.studentdata',compact('data'));
    }
    public function resetpassword($id)
    {
        $data=User::find($id);
        $data->password=bcrypt($data->studentid);
        $data->save();
        Session::flash('success', 'Student Password Reset has successfully done.');
        return redirect()->back();
    }

}

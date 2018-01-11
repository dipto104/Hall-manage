<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Requeststudent;
use Illuminate\Http\Request;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class Requestroomcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:asstprovost');
    }
    public function showroominsertreq()
    {
        return view('forasstprovost.roominsertreqdata');
    }
    public function roominsertreq()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $requesttype="INSERT";
        $users= DB::select('select * from requestrooms  where requesttype =:requesttype',['requesttype' =>$requesttype]);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/asstprovost/perroomreqinfo/$user->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function perroominsertreq($id)
    {
        $data=Requestroom::find($id);
        return view('forasstprovost.roominsertreqinfo',compact('data'));
    }
    public function studentinsertallow($id){
        $data=Requeststudent::find($id);
        $data->delete();
        Session::flash('success', 'This srudent data is inserted permanently.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function studentinsertreject($id){
        $data=Requeststudent::find($id);
        DB::table('users')->where('studentid','=',$data->studentid)->delete();

        $dataroom=DB::select('select * from rooms where roomno = :roomno',['roomno' => $data->roomno]);
        $room=Room::find($dataroom[0]->id);
        $room->occupy=$room->occupy-1;
        $room->save();

        $data->delete();
        Session::flash('success', 'This Request is rejected.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function studentinsertallowall(){
        $data=Requeststudent::all();
        foreach ($data as $singledata){
            $singledata->delete();
        }

        Session::flash('success', 'All Srudent_Insert Request is accpted.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function studentinsertrejectall(){
        $data=Requeststudent::all();
        foreach ($data as $singledata){
            DB::table('users')->where('studentid','=',$singledata->studentid)->delete();

            $dataroom=DB::select('select * from rooms where roomno = :roomno',['roomno' => $singledata->roomno]);
            $room=Room::find($dataroom[0]->id);
            $room->occupy=$room->occupy-1;
            $room->save();
            $singledata->delete();
        }
        Session::flash('success', 'ALL the Request is rejected.');
        return redirect()->route('provost.studentreqinsertshow');
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Requeststudent;
use Illuminate\Http\Request;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class Requestcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:provost');
    }
    public function showstudentinsertreq()
    {
        return view('forprovost.studentreqdata');
    }
    public function studentinsertreq()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $requesttype="INSERT";
        $users= DB::select('select * from requeststudents  where requesttype =:requesttype',['requesttype' =>$requesttype]);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/provost/perstudentreqinfo/$user->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function perstudentinsertreq($id)
    {
        $data=Requeststudent::find($id);
        return view('forprovost.studentreqinfo',compact('data'));
    }
    public function studentinsertallow($id){
        $data=Requeststudent::find($id);
        $data->delete();
        Session::flash('success', 'This srudent data is inserted permanently.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function studentinsertreject($id){
        $data=Requeststudent::find($id);
        if($data->requesttype=="RESIDENT"){
            DB::table('allusers')->where('userid','=',$data->studentid)->delete();
            DB::table('users')->where('studentid','=',$data->studentid)->delete();

            $dataroom=DB::select('select * from rooms where roomno = :roomno',['roomno' => $data->roomno]);
            $room=Room::find($dataroom[0]->id);
            $room->occupy=$room->occupy-1;
            $room->save();
        }
        else if($data->requesttype=="ATTACHED"){
            DB::table('attachedstudents')->where('studentid','=',$data->studentid)->delete();

        }




        $data->delete();
        Session::flash('success', 'This Request is rejected.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function studentinsertallowall(){
        $data=Requeststudent::all();
        foreach ($data as $singledata){
            if($singledata->requesttype=="INSERT") {
                $singledata->delete();
            }
        }

        Session::flash('success', 'All Srudent_Insert Request is accpted.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function studentinsertrejectall(){
        $data=Requeststudent::all();
        foreach ($data as $singledata){
            if($singledata->requesttype=="INSERT") {
                if($singledata->requesttype=="RESIDENT") {
                    DB::table('allusers')->where('userid', '=', $singledata->studentid)->delete();
                    DB::table('users')->where('studentid', '=', $singledata->studentid)->delete();
                    $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $singledata->roomno]);
                    $room = Room::find($dataroom[0]->id);
                    $room->occupy = $room->occupy - 1;
                    $room->save();

                }
                else if($singledata->requesttype=="ATTACHED"){
                    DB::table('attachedstudents')->where('studentid','=',$singledata->studentid)->delete();
                }
                $singledata->delete();
            }
        }
        Session::flash('success', 'ALL the Request is rejected.');
        return redirect()->route('provost.studentreqinsertshow');
    }
    public function showstudentdeletereq()
    {
        return view('forprovost.studelreqdata');
    }
    public function studentdeletereq()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $requesttype="DELETE";
        $users= DB::select('select * from requeststudents  where requesttype =:requesttype',['requesttype' =>$requesttype]);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/provost/perstudentdeletereqinfo/$user->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function perstudentdeletereq($id)
    {
        $data=Requeststudent::find($id);
        return view('forprovost.studelreqinfo',compact('data'));
    }
    public function studentdeleteallow($id){
        $data=Requeststudent::find($id);
        if($data->requesttype=="RESIDENT") {
            DB::table('allusers')->where('userid', '=', $data->studentid)->delete();
            DB::table('users')->where('studentid', '=', $data->studentid)->delete();


            $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $data->roomno]);
            $room = Room::find($dataroom[0]->id);
            $room->occupy = $room->occupy - 1;
            $room->save();
        }
        else if($data->requesttype=="ATTACHED"){
            DB::table('attachedstudents')->where('studentid','=',$data->studentid)->delete();

        }


        $data->delete();
        Session::flash('success', 'This student data is deleted permanently.');
        return redirect()->route('provost.studentreqdeleteshow');
    }
    public function studentdeletereject($id){
        $data=Requeststudent::find($id);
        $data->delete();
        Session::flash('success', 'This Request is rejected.');
        return redirect()->route('provost.studentreqdeleteshow');
    }
    public function studentdeleteallowall(){
        $datas=Requeststudent::all();
        foreach ($datas as $data) {
            if($data->requesttype=="DELETE") {
                if ($data->requesttype == "RESIDENT") {
                    DB::table('allusers')->where('userid', '=', $data->studentid)->delete();
                    DB::table('users')->where('studentid', '=', $data->studentid)->delete();


                    $dataroom = DB::select('select * from rooms where roomno = :roomno', ['roomno' => $data->roomno]);
                    $room = Room::find($dataroom[0]->id);
                    $room->occupy = $room->occupy - 1;
                    $room->save();
                } else if ($data->requesttype == "ATTACHED") {
                    DB::table('attachedstudents')->where('studentid', '=', $singledata->studentid)->delete();
                }
                $data->delete();
            }



        }
        Session::flash('success', 'All Srudent_delete Request are accpted.');
        return redirect()->route('provost.studentreqdeleteshow');
    }
    public function studentdeleterejectall(){
        $data=Requeststudent::all();
        foreach ($data as $singledata) {
            if($singledata->requesttype=="DELETE") {
                $singledata->delete();
            }
        }
        Session::flash('success', 'All The Request are rejected.');
        return redirect()->route('provost.studentreqdeleteshow');
    }
}

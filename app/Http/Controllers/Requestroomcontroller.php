<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Requestroom;
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
    public function roominsertallow($id){
        $data=Requestroom::find($id);
        $data->delete();
        Session::flash('success', 'This Room_Insert Request is accepted.');
        return redirect()->route('asstprovost.roomreqinsertshow');
    }
    public function roominsertreject($id){
        $data=Requestroom::find($id);
        DB::table('rooms')->where('roomno','=',$data->roomno)->delete();
        $data->delete();
        Session::flash('success', 'This Request is rejected.');
        return redirect()->route('asstprovost.roomreqinsertshow');
    }
    public function roominsertallowall(){
        $data=Requestroom::all();
        foreach ($data as $singledata){
            $singledata->delete();
        }

        Session::flash('success', 'All Room_Insert Request is accpted.');
        return redirect()->route('asstprovost.roomreqinsertshow');
    }
    public function roominsertrejectall(){
        $data=Requestroom::all();
        foreach ($data as $singledata){
            DB::table('rooms')->where('roomno','=',$singledata->roomno)->delete();
            $singledata->delete();
        }
        Session::flash('success', 'ALL the Request is rejected.');
        return redirect()->route('asstprovost.roomreqinsertshow');
    }



    public function showroomdeletereq()
    {
        return view('forasstprovost.roomdelreqdata');
    }
    public function roomdeletereq()
    {
        //$users = User::select(['id', 'name', 'studentid', 'created_at']);
        $requesttype="DELETE";
        $users= DB::select('select * from requestrooms  where requesttype =:requesttype',['requesttype' =>$requesttype]);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/asstprovost/perroomdeletereqinfo/$user->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function perroomdeletereq($id)
    {
        $data=Requestroom::find($id);
        return view('forasstprovost.roomdelreqinfo',compact('data'));
    }
    public function roomdeleteallow($id){
        $data=Requestroom::find($id);
        DB::table('rooms')->where('roomno','=',$data->roomno)->delete();
        $data->delete();
        Session::flash('success', 'The Room Delete request is accepted.');
        return redirect()->route('asstprovost.roomreqdeleteshow');
    }
    public function roomdeletereject($id){
        $data=Requestroom::find($id);
        $data->delete();
        Session::flash('success', 'This Request is rejected.');
        return redirect()->route('asstprovost.roomreqdeleteshow');
    }
    public function roomdeleteallowall(){
        $datas=Requestroom::all();
        foreach ($datas as $data) {
            DB::table('rooms')->where('roomno', '=', $data->roomno)->delete();
            $data->delete();
        }
        Session::flash('success', 'All Room_delete Request are accpted.');
        return redirect()->route('asstprovost.roomreqdeleteshow');
    }
    public function roomdeleterejectall(){
        $data=Requestroom::all();
        foreach ($data as $singledata) {
            $singledata->delete();
        }
        Session::flash('success', 'All The Request are rejected.');
        return redirect()->route('asstprovost.roomreqdeleteshow');
    }
}

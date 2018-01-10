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
        $requesttype="insert";
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
        DB::table('users')->where('studentid','=',$data->studentid)->delete();
        $data->delete();
        return redirect()->route('provost.studentreqinsertshow');
    }
}

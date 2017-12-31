<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use Illuminate\Validation\Rule;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
class Roomcontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showinsertroom()
    {
        return view('foradmin.room.insertroom');
    }
    public function insertroom(Request $request)
    {
        $this->validate($request, [
            'roomno' => 'required|numeric|unique:rooms',
            'roomtype' => 'required|',
            'capacity' => 'required|numeric',
        ]);

        $roomno=$request['roomno'];
        $roomtype=$request['roomtype'];
        $capacity=$request['capacity'];
        $occupy=0;


        $room=new Room();
        $room->roomno=$roomno;
        $room->roomtype=$roomtype;
        $room->capacity=$capacity;
        $room->occupy=$occupy;


        $room->save();
        Session::flash('success', 'This room data were successfully saved.');



        //$data=User::all();
        return redirect()->route('admin.roomdata');

       // return view('foradmin.studentdata',compact('data'));
    }
    public function roomdata()
    {
        return view('foradmin.room.roomdata');
    }
    public function roomdatashow()
    {
        $rooms= DB::select('select * from rooms');

        return Datatables::of($rooms)
            ->addColumn('action', function ($room) {
                return "<a href='/admin/perstudentinfo/$room->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
}

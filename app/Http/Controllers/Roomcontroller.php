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
                return "<a href='/admin/perroominfo/$room->id' class='btn btn-xs btn-primary'></i> OPEN</a>";
            })
            ->make(true);
    }
    public function perroom($id)
    {
        $data=Room::find($id);

        return view('foradmin.room.perroominfo',compact('data'));
    }
    public function showeditroom($id)
    {
        $data=Room::find($id);

        return view('foradmin.room.editroom',compact('data'));
    }
    public function editroom(Request $request,$id)
    {


        $this->validate($request, [
            'roomno' => ['required','numeric',Rule::unique('rooms')->ignore($id)],
            'roomtype' => 'required|',
            'capacity' => 'required|numeric',
        ]);

        $roomno=$request['roomno'];
        $roomtype=$request['roomtype'];
        $capacity=$request['capacity'];


        $room=Room::find($id);
        $room->roomno=$roomno;
        $room->roomtype=$roomtype;
        $room->capacity=$capacity;


        $room->save();
        Session::flash('success', 'This room data were successfully saved.');



        //$data=User::all();
        return redirect()->route('admin.roomdata');


    }
    public function importroom(Request $request)
    {
        //dd( $request->file('file') );
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt',

        ]);
        if(($handle = fopen($_FILES['file']['tmp_name'],"r"))!=false){
            fgetcsv($handle);
            while (($data=fgetcsv($handle,1000,","))!=false){
                //echo $data[0];
                $roomno=$data[0];
                $roomtype=$data[1];
                $capacity=$data[2];
                $occupy=$data[3];


                $room=new Room();
                $room->roomno=$roomno;
                $room->roomtype=$roomtype;
                $room->capacity=$capacity;
                $room->occupy=$occupy;
                $room->save();


                Session::flash('success', 'This room data were successfully saved.');





            }
        }
        return redirect()->route('admin.roomdata');

    }
}

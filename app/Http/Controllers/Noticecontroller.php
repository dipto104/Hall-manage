<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use App\Notice;
use App\Requestroom;
use Illuminate\Validation\Rule;
use Session;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Noticecontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function shownoticeinsert()
    {
        return view('foradmin.notice.insertnotice');
    }
    public function insertnotice(Request $request){
        $this->validate($request, [
            'noticename' => 'required|',
            'noticebody' => 'required|',
        ]);

        $noticename=$request['noticename'];
        $noticebody=$request['noticebody'];



        $notice=new Notice();
        $notice->noticename=$noticename;
        $notice->noticebody=$noticebody;
        if(Auth::guard('provost')->check()){
            $notice->noticeby="PROVOST SIR";
        }
        else if(Auth::guard('asstprovost')->check()){
            $notice->noticeby="Assitant PROVOST SIR";
        }
        else if(Auth::guard('admin')->check()){
            $notice->noticeby="Hall Office";
        }
        $notice->save();
        return redirect()->route('admin.shownotice');
    }
    public function shownoticedata()
    {
        $data=Notice::paginate(2);
        return view('foradmin.notice.noticedata',compact('data'));
    }
    //
}

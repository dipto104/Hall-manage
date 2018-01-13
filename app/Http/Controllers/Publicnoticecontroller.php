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
use Illuminate\Support\Facades\Storage;

class Publicnoticecontroller extends Controller
{
    //
    public function publicnotice()
    {
        $data = Notice::orderBy('id','desc')->paginate(3);
        return view('foradmin.notice.publicnotice', compact('data'));
    }
    public function perpublicnotice($id){
        $data=Notice::find($id);
        return view('foradmin.notice.perpublicnoticeinfo', compact('data'));
    }
}

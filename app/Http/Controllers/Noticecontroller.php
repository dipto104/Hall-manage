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

    public function insertnotice(Request $request)
    {
        $this->validate($request, [
            'noticename' => 'required|',
            'noticebody' => 'required|',
        ]);

        $noticename = $request['noticename'];
        $noticebody = $request['noticebody'];


        $notice = new Notice();
        $notice->noticename = $noticename;
        $notice->noticebody = $noticebody;
        if (Auth::guard('provost')->check()) {
            $notice->noticeby = "PROVOST SIR";
        } else if (Auth::guard('asstprovost')->check()) {
            $notice->noticeby = "Assitant PROVOST SIR";
        } else if (Auth::guard('admin')->check()) {
            $notice->noticeby = "Hall Office";
        }
        $notice->save();
        Session::flash('success', 'The Notice is successfully saved.');
        return redirect()->route('admin.shownotice');
    }

    public function shownoticedata()
    {
        $data = Notice::orderBy('id','desc')->paginate(5);
        return view('foradmin.notice.noticedata', compact('data'));
    }

    public function pernotice($id)
    {
        $data = Notice::find($id);
        return view('foradmin.notice.pernoticeinfo', compact('data'));
    }

    public function editnoticeshow($id)
    {
        $data = Notice::find($id);
        return view('foradmin.notice.editnotice', compact('data'));
    }

    public function editnotice(Request $request, $id)
    {
        $this->validate($request, [
            'noticename' => 'required|',
            'noticebody' => 'required|',
        ]);

        $noticename = $request['noticename'];
        $noticebody = $request['noticebody'];


        $notice = Notice::find($id);
        if ($notice->noticeby == "PROVOST SIR" && !Auth::guard('provost')->check()) {
            Session::flash('danger', 'This Notice can be edited by only PROVOST SIR.');
            return redirect()->back();
        }
        else if($notice->noticeby == "Assitant PROVOST SIR" && (!Auth::guard('asstprovost')->check() && !Auth::guard('provost')->check()))
        {
            Session::flash('danger', 'This Notice can be edited by only PROVOST SIR and Assitant PROVOST SIR.');
            return redirect()->back();
        }
        $notice->noticename = $noticename;
        $notice->noticebody = $noticebody;
        if (Auth::guard('provost')->check()) {
            $notice->noticeby = "PROVOST SIR";
        } else if (Auth::guard('asstprovost')->check()) {
            $notice->noticeby = "Assitant PROVOST SIR";
        } else if (Auth::guard('admin')->check()) {
            $notice->noticeby = "Hall Office";
        }
        $notice->save();
        Session::flash('success', 'This Notice is successfully edited.');
        return redirect()->route('admin.shownotice');
        //
    }
    public function destroy($id)
    {
        $notice = Notice::find($id);
        if ($notice->noticeby == "PROVOST SIR" && !Auth::guard('provost')->check()) {
            Session::flash('danger', 'This Notice can be deleted by only PROVOST SIR.');
            return redirect()->back();
        }
        else if($notice->noticeby == "Assitant PROVOST SIR" && (!Auth::guard('asstprovost')->check() && !Auth::guard('provost')->check()))
        {
            Session::flash('danger', 'This Notice can be deleted by only PROVOST SIR and Assitant PROVOST SIR.');
            return redirect()->back();
        }
        $notice->delete();
        Session::flash('success', 'This Notice is successfully deleted.');
        return redirect()->route('admin.shownotice');

    }
}

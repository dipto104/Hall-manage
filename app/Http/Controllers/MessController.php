<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\Mess;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class MessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('foradmin.hallmess'); // this return the view with all button the dining payment view
    }
    public function termindex()
    {
        return view('foradmin.mess.insertterm');//this will give the view of insert new term
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function termcreate(Request $request)
    {
        $this->validate($request, [
            'termno' => 'required|numeric|unique:terms',
            'startat' =>'required',


        ]);

        $termno=$request['termno'];
        $startat=$request['startat'];
        $finishat=$request['finishat'];



        $data=new Term();
        $data->termno=$termno;
        $data->startat=$startat;

        if(strlen($finishat)){
            $data->finishat=$finishat;
        }
        else{
            $finishat=null;
            $data->finishat=$finishat;
        }
        $data->save();
        Session::flash('success', 'New Term has been Created Successfully.');



        //$data=User::all();

        //return view('foradmin.studentdata',compact('data'));
        return view('foradmin.hallmess');

    }
    public function showterms()
    {
        $data=Term::all();

        return view('foradmin.mess.termdata',compact('data'));
    }
    public function openterm($id)
    {
        $data=Term::find($id);

        return view('foradmin.mess.messpayment',compact('data'));
    }
    public function indexmess($id)
    {
        $datamess=Term::find($id);
        return view('foradmin.mess.createmess',compact('datamess'));
    }
    public function messcreate(Request $request,$id)
    {
        $this->validate($request, [
            'messno' => 'required|numeric',
            'startat' =>'required',
            'finishat' =>'required',
            'fine' => 'required|numeric'


        ]);



        $termno=$id;
        $messno=$request['messno'];
        $startat=$request['startat'];
        $finishat=$request['finishat'];
        $vacstartat=$request['vacstartat'];
        $vacfinishat=$request['vacfinishat'];
        $fine=$request['fine'];


        $results = DB::select('select * from messes where messno = :messno and termno = :termno', ['messno' => $messno,'termno' => $termno]);

        if($results!=null){
            Session::flash('danger', 'Duplicate Mess No in this term.');
            return redirect()->back()->withInput();

        }

        $data=new Mess();
        $data->messno=$messno;
        $data->termno=$termno;
        $data->startat=$startat;
        $data->finishat=$finishat;
        $data->fine=$fine;

        if(strlen($vacstartat)){
            $data->vacstartat=$vacstartat;
        }
        else{
            $vacstartat=null;
            $data->vacstartat=$vacstartat;
        }
        if(strlen($vacfinishat)){
            $data->vacfinishat=$vacfinishat;
        }
        else{
            $vacfinishat=null;
            $data->vacfinishat=$vacfinishat;
        }
        $data->save();
        Session::flash('success', 'New Mess has been Created Successfully.');



        //$data=User::all();

        //return view('foradmin.studentdata',compact('data'));
        return view('foradmin.hallmess');

    }
    public function showmess($id)
    {
        $data=DB::select('select * from messes where  termno = :termno', ['termno' => $id]);

        return view('foradmin.mess.messdata',compact('data'));
    }
    public function editmess($id)
    {
        $data=Mess::find($id);

        return view('foradmin.mess.editmess',compact('data'));
    }
    public function messupdate(Request $request,$id)
    {
        $this->validate($request, [
            'messno' => 'required|numeric',
            'startat' =>'required',
            'finishat' =>'required',
            'fine' => 'required|numeric'


        ]);




        $messno=$request['messno'];
        $startat=$request['startat'];
        $finishat=$request['finishat'];
        $vacstartat=$request['vacstartat'];
        $vacfinishat=$request['vacfinishat'];
        $fine=$request['fine'];

        $data= Mess::find($id);

        $termno=$data->termno;
        $results = DB::select('select * from messes where messno = :messno and termno = :termno and id <> :id', ['messno' => $messno,'termno' => $termno,'id' => $id]);

        if($results!=null){
            Session::flash('danger', 'Duplicate Mess No in this term.');
            return redirect()->back()->withInput();

        }


        $data->messno=$messno;
        $data->termno=$termno;
        $data->startat=$startat;
        $data->finishat=$finishat;
        $data->fine=$fine;

        if(strlen($vacstartat)){
            $data->vacstartat=$vacstartat;
        }
        else{
            $vacstartat=null;
            $data->vacstartat=$vacstartat;
        }
        if(strlen($vacfinishat)){
            $data->vacfinishat=$vacfinishat;
        }
        else{
            $vacfinishat=null;
            $data->vacfinishat=$vacfinishat;
        }
        $data->save();
        Session::flash('success', 'This Mess has been Updated Successfully.');



        //$data=User::all();

        //return view('foradmin.studentdata',compact('data'));
        return view('foradmin.hallmess');

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function editterm($id)
    {
        $data=Term::find($id);

        return view('foradmin.mess.editterm',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateterm(Request $request, $id)
    {
        $this->validate($request, [
            'termno' => ['required','numeric',Rule::unique('terms')->ignore($id)],
            'startat' =>'required',


        ]);

        $termno=$request['termno'];
        $startat=$request['startat'];
        $finishat=$request['finishat'];



        $data=Term::find($id);
        $data->termno=$termno;
        $data->startat=$startat;

        if(strlen($finishat)){
            $data->finishat=$finishat;
        }
        else{
            $finishat=null;
            $data->finishat=$finishat;
        }
        $data->save();
        Session::flash('success', 'The Term has been Successfully Updated.');



        //$data=User::all();

        //return view('foradmin.studentdata',compact('data'));
        return view('foradmin.hallmess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

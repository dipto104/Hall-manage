<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use Session;

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
        return view('foradmin.hallmess');
    }
    public function termindex()
    {
        return view('foradmin.mess.insertterm');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

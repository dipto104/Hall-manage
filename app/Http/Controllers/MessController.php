<?php

namespace App\Http\Controllers;

use App\Payment;

use  Illuminate\Http\Request;
use App\Term;
use App\User;
use App\Mess;
use App\Termdue;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class MessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $datamess = Mess::class;
    public $termid = 1;
    public $counter = 0;

    public function __construct()
    {
        $this->middleware('auth:admin' or 'auth:provost');
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
            'termno' => 'required|unique:terms',
            'startat' => 'required',


        ]);

        $termno = $request['termno'];
        $startat = $request['startat'];
        $finishat = $request['finishat'];


        $data = new Term();
        $data->termno = $termno;
        $data->startat = $startat;

        if (strlen($finishat)) {
            $data->finishat = $finishat;
        } else {
            $finishat = null;
            $data->finishat = $finishat;
        }
        $data->save();
        Session::flash('success', 'New Term has been Created Successfully.');


        $data = Term::all();

        return view('foradmin.mess.termdata', compact('data'));

    }

    public function showterms()
    {

        return view('foradmin.mess.termdata');

    }

    public function showtermdata()
    {
        $users = DB::select('select * from terms');

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/perterminfo/$user->id' class='btn btn-xs btn-primary'></i><span class=\"glyphicon glyphicon-folder-open\"></span> OPEN</a>";
            })
            ->make(true);
    }

    public function destroyterm($id)
    {
        $dataterm = Term::find($id);
        $termno = $dataterm->termno;
        //$datamess=DB::table('messes')->where('termno','=',$termno)->get();
        $datamess = DB::select('select * from messes where  termno = :termno', ['termno' => $termno]);
        if ($datamess != null) {
            Session::flash('danger', 'The Term is not empty.');
            return redirect()->back();
        }
        DB::table('termdues')->where('termno', '=', $termno)->delete();
        $dataterm->delete();
        return redirect()->route('admin.termdata');
    }

    public function editterm($id)
    {
        $data = Term::find($id);

        return view('foradmin.mess.editterm', compact('data'));
    }

    public function perterm($id)
    {
        $data = Term::find($id);

        return view('foradmin.mess.perterminfo', compact('data'));
    }

    public function openterm($id)
    {
        $data = Term::find($id);

        return view('foradmin.mess.messpayment', compact('data'));
    }

    public function indexmess($id)
    {
        $datamess = Term::find($id);
        return view('foradmin.mess.createmess', compact('datamess'));
    }

    public function messcreate(Request $request, $id)
    {
        $this->validate($request, [
            'messno' => 'required|numeric',
            'startat' => 'required',
            'finishat' => 'required',
            'fine' => 'required|numeric',
            'messfee' => 'required|numeric'


        ]);
        $termdata=Term::find($id);
        $termno = $termdata->termno;
        $messno = $request['messno'];
        $startat = $request['startat'];
        $finishat = $request['finishat'];
        $vacnumber = $request['vacnumber'];
        $fine = $request['fine'];
        $messfee = $request['messfee'];
        $extrafee = $request['extrafee'];


        $results = DB::select('select * from messes where messno = :messno and termno = :termno', ['messno' => $messno, 'termno' => $termno]);

        if ($results != null) {
            Session::flash('danger', 'Duplicate Mess No in this term.');
            return redirect()->back()->withInput();

        }

        $data = new Mess();
        $data->messno = $messno;
        $data->termno = $termno;
        $data->startat = $startat;
        $data->finishat = $finishat;
        $data->fine = $fine;
        $data->messfee = $messfee;

        if (strlen($vacnumber)) {
            $data->vacnumber = $vacnumber;
        } else {
            $vacnumber = null;
            $data->vacnumber = $vacnumber;
        }
        if (strlen($extrafee)) {
            $data->extrafee = $extrafee;
        } else {
            $extrafee = null;
            $data->extrafee = $extrafee;
        }
        $data->save();
        $this->autopaymentcreate($termno, $messno);
        Session::flash('success', 'New Mess has been Created Successfully.');


        $data = DB::select('select * from messes where  termno = :termno', ['termno' => $termno]);

        return view('foradmin.mess.messdata', compact('data'));

    }

    public function autopaymentcreate($termno, $messno)
    {
        $alldata = User::all();
        $datamess = DB::select('select * from messes where  termno = :termno and messno = :messno', ['termno' => $termno, 'messno' => $messno]);
        $finedate = date('Y-m-d', strtotime($datamess[0]->startat . ' + 7 days'));
        foreach ($alldata as $data) {
            $payment = new Payment();
            $payment->termno = $termno;
            $payment->messno = $messno;
            $payment->studentid = $data->studentid;
            $payment->finestartat = $finedate;
            $payment->name = $data->name;
            $payment->roomno = $data->roomno;
            $payment->department = $data->department;
            $payment->save();
        }
    }

    public function openpayment($id)
    {
        $mess = Mess::find($id);
        $termno = $mess->termno;
        $messno = $mess->messno;
        $data = DB::select('select * from payments where messno = :messno and termno = :termno', ['messno' => $messno, 'termno' => $termno]);
        $data[0]->fine = $id;///big big big problem with bug here
        return view('foradmin.mess.openpayment', compact('data'));
        //return view('foradmin.mess.openpayment');

    }

    public function showpaymentdata($id)
    {

        $mess = Mess::find($id);
        $termno = $mess->termno;
        $messno = $mess->messno;
        $users = DB::select('select * from payments where messno = :messno and termno = :termno', ['messno' => $messno, 'termno' => $termno]);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/perpaymentinfo/$user->id' class='btn btn-xs btn-primary'></i><span class=\"glyphicon glyphicon-folder-open\"></span> OPEN</a>";
            })
            ->make(true);
    }

    public function perpayment($id)
    {
        $data = Payment::find($id);
        return view('foradmin.mess.perpaymentinfo', compact('data'));
    }

    public function editpayment($id)
    {
        $data = Payment::find($id);
        return view('foradmin.mess.editpayment', compact('data'));

    }

    public function finepermess($id)
    {
        $mess = Payment::find($id);
        $termno = $mess->termno;
        $messno = $mess->messno;
        $datapay = DB::select('select * from payments where messno = :messno and termno = :termno', ['messno' => $messno, 'termno' => $termno]);
        $datamess = DB::select('select * from messes where messno = :messno and termno = :termno', ['messno' => $messno, 'termno' => $termno]);


        foreach ($datapay as $pay) {
            foreach ($datamess as $datames) {
                if ($pay->remarks == null) {
                    $startdate = strtotime($datames->startat);
                    $finishdate = strtotime($datames->finishat);
                    $datediff = $finishdate - $startdate;
                    $days = floor($datediff / (60 * 60 * 24))+1;
                    if ($datames->vacnumber != null) {
                        $days = $days - $datames->vacnumber;
                    }
                    $fine = $days * $datames->fine;
                    $fine = $fine + $datames->messfee + $datames->extrafee;

                    $temp = Payment::find($pay->id);

                    $temp->due = $fine;
                    $temp->save();
                } else {
                    $startdate = strtotime($datames->startat);
                    $receivedate = strtotime($pay->receivedate);
                    $datediff = $receivedate - $startdate;
                    $days = floor($datediff / (60 * 60 * 24))+1;
                    if ($datames->vacnumber != null) {
                        $days = $days - $datames->vacnumber;
                    }
                    $days = $days - 7;
                    if ($days < 0) {
                        $days = 0;
                    }
                    $fine = $datames->fine;
                    $fine = (int)$fine;
                    $fine = $days * $fine;
                    //if($fine>($datames->fine*30)){
                    //    $fine=$datames->fine*30;
                    //}
                    $fine = $fine + $datames->messfee + $datames->extrafee - $pay->fee;
                    $temp = Payment::find($pay->id);
                    $temp->due = $fine;
                    $temp->save();
                }
            }

        }
        $data = DB::select('select * from payments where messno = :messno and termno = :termno', ['messno' => $messno, 'termno' => $termno]);
        $data[0]->fine = $datamess[0]->id;//this is done for remove error
        ////sending needed messid show datatable for accurate mess
        return view('foradmin.mess.openpayment', compact('data'));
    }

    public function showdueperterm($id)
    {
        $termdata=Term::find($id);
        $datatermdue=DB::select('select * from termdues where  termno = :termno and due > :due', ['termno' => $termdata->termno,'due' => 0]);
        return view('foradmin.mess.termdue',compact('datatermdue'));
    }
    public function dueperterm($id)
    {
        $termdata=Term::find($id);
        $students=User::all();
        $test=DB::select('select * from payments where  termno = :termno', ['termno' => $termdata->termno]);
        if($test==null){
            $datatermdue=null;
            return view('foradmin.mess.termdue',compact('datatermdue'));
        }
        else{
            $totaldue = 0;
            $datatermdue = DB::select('select * from termdues where  termno = :termno', ['termno' => $termdata->termno]);
            foreach ($students as $student) {
                $payments = DB::select('select * from payments where studentid = :studentid and termno = :termno', ['studentid' => $student->studentid, 'termno' => $termdata->termno]);
                $i = 0;
                foreach ($payments as $pay) {
                    $totaldue = $totaldue + $pay->due;
                    $i++;
                }

                if ($datatermdue == null) {
                    $data = new Termdue();
                    $data->termno = $termdata->termno;
                    $data->studentid = $student->studentid;
                    $data->name=$student->name;
                    $data->roomno=$student->roomno;
                    $data->totalmess = $i;
                    $data->due = $totaldue;
                    if($totaldue==0){
                        $data->remarks = "cleared";
                    }
                    else if($totaldue<0){
                        $data->remarks = "extrapaid";
                    }
                    else{
                        $data->remarks = "due";
                    }
                    $data->save();
                } else {
                    $datastudent = DB::select('select * from termdues where studentid = :studentid and termno = :termno', ['studentid' => $student->studentid, 'termno' => $termdata->termno]);
                    if ($datastudent == null) {
                        $data = new Termdue();
                        $data->termno = $termdata->termno;
                        $data->studentid = $student->studentid;
                        $data->name=$student->name;
                        $data->roomno=$student->roomno;
                        $data->totalmess = $i;
                        $data->due = $totaldue;
                        if($totaldue==0){
                            $data->remarks = "cleared";
                        }
                        else if($totaldue<0){
                            $data->remarks = "extrapaid";
                        }
                        else{
                            $data->remarks = "due";
                        }
                        $data->save();
                    } else {
                        foreach ($datastudent as $datastu) {
                            $data = Termdue::find($datastu->id);
                            $data->termno = $termdata->termno;
                            $data->studentid = $student->studentid;
                            $data->name=$student->name;
                            $data->roomno=$student->roomno;
                            $data->totalmess = $i;
                            $data->due = $totaldue;
                            if($totaldue==0){
                                $data->remarks = "cleared";
                            }
                            else if($totaldue<0){
                                $data->remarks = "extrapaid";
                            }
                            else{
                                $data->remarks = "due";
                            }
                            $data->save();
                        }
                    }


                }
                $totaldue = 0;
            }
            //$totalmess=DB::select('select * from messes where termno = :termno', ['termno' => $termdata->termno]);
            $datatermdue = DB::select('select * from termdues where  termno = :termno', ['termno' => $termdata->termno]);
            return view('foradmin.mess.termdue', compact('datatermdue'));
        }

    }
    public function exporttermdue($termno)
    {
        $datas = DB::select('select * from termdues where  termno = :termno and due <>:due', ['termno' => $termno , 'due' =>0]);
        $student="";
        if(count($datas)>0){
            $student.= '<table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Room No</th>
                <th>Total Mess</th>
                <th>Due Payment</th>
                <th>Remarks</th>
            </tr>';


        }
        foreach ($datas as $data){
            $student.='
            <tr>
            <td>'.$data->studentid.'</td>
            <td>'.$data->name.'</td>
            <td>'.$data->roomno.'</td>
            <td>'.$data->totalmess.'</td>
            <td>'.$data->due.'</td>
            <td>'.$data->remarks.'</td>
            </tr>';

        }
        $student.='</table>';
        header('Content_Type: application/xls');
        header('Content-Disposition: atttachment; filename=termdue.xls');

        echo $student;

    }

    public function updatepayment(Request $request,$id)
    {
        $this->validate($request, [
            'hallscroll' => 'required|numeric',
            'bankscroll' =>'required|numeric',
            'receivedate'=>'required',
            'fee' => 'required|numeric',
            'remarks' => 'required',


        ]);

        $hallscroll=$request['hallscroll'];
        $bankscroll=$request['bankscroll'];
        $receivedate=$request['receivedate'];
        $fee=$request['fee'];
        $remarks=$request['remarks'];



        $data=Payment::find($id);
        $data->hallscroll=$hallscroll;
        $data->bankscroll=$bankscroll;
        $data->receivedate=$receivedate;
        $data->fee=$fee;
        $data->remarks=$remarks;



        $data->save();
        Session::flash('success', "$data->name 's Payment has been Successfully Saved.");



        $termno=$data->termno;
        $messno=$data->messno;
        $data = DB::select('select * from payments where messno = :messno and termno = :termno', ['messno' => $messno,'termno' => $termno]);

        //below is done for remove error to give mess id to the function of show paymentdata
        $data2 = DB::select('select * from messes where messno = :messno and termno = :termno', ['messno' => $messno,'termno' => $termno]);
        $data[0]->fine=$data2[0]->id;
        return view('foradmin.mess.openpayment',compact('data'));
        //$this->openpayment($messno);
        //$this->showpaymentdata($messno);
    }
    public function showmess($id)
    {
        $data= DB::select('select * from messes where  termno = :termno', ['termno' => $id]);
        return view('foradmin.mess.messdata',compact('data'));
    }

    public function showmessdata($id)
    {
        $users= DB::select('select * from messes where  termno = :termno', ['termno' => $id]);
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return "<a href='/admin/permessinfo/$user->id' class='btn btn-xs btn-primary'></i><span class=\"glyphicon glyphicon-folder-open\"></span> OPEN</a>";
            })
            ->make(true);
    }
    public function editmess($id)
    {
        $data=Mess::find($id);

        return view('foradmin.mess.editmess',compact('data'));
    }
    public function permess($id)
    {
        $data=Mess::find($id);

        return view('foradmin.mess.permessinfo',compact('data'));
    }
    public function destroymess($id)
    {
        $data=Mess::find($id);
        $termno=$data->termno;
        $messno=$data->messno;
        DB::table('payments')->where([
            ['messno', '=', $messno],
            ['termno', '=', $termno],
        ])->delete();

        $dataterm=DB::table('terms')->where('termno','=',$termno)->get();
        $data->delete();
        Session::flash('success', 'The mess was successfully deleted.');

        return redirect()->route('admin.messdata',$termno);
    }
    public function messupdate(Request $request,$id)
    {
        $this->validate($request, [
            'messno' => 'required|numeric',
            'startat' =>'required',
            'finishat' =>'required',
            'fine' => 'required|numeric',
            'messfee' => 'required|numeric'


        ]);




        $messno=$request['messno'];
        $startat=$request['startat'];
        $finishat=$request['finishat'];
        $vacnumber=$request['vacnumber'];
        $fine=$request['fine'];
        $messfee=$request['messfee'];
        $extrafee=$request['extrafee'];

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
        $data->messfee=$messfee;

        if(strlen($vacnumber)){
            $data->vacnumber=$vacnumber;
        }
        else{
            $vacnumber=null;
            $data->vacnumber=$vacnumber;
        }
        if(strlen($extrafee)){
            $data->extrafee=$extrafee;
        }
        else{
            $extrafee=null;
            $data->extrafee=$extrafee;
        }
        $data->save();
        Session::flash('success', 'This Mess has been Updated Successfully.');



        //$data=User::all();

        //return view('foradmin.studentdata',compact('data'));
        $data=DB::select('select * from messes where  termno = :termno', ['termno' => $termno]);

        return view('foradmin.mess.messdata',compact('data'));


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
            'termno' => ['required',Rule::unique('terms')->ignore($id)],
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

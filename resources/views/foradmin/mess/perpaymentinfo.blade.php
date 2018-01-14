@extends('layouts.appall')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Term No :{{ $data->termno }}|Mess No :{{ $data->messno }} 's Data</h4></div>
                    <div class="panel-body">
                        <p class="lead">Student ID : {{ $data->studentid }}</p>
                        <p class="lead">Name : {{ $data->name }}</p>
                        <p class="lead">Department : {{ $data->department }}</p>
                        <p class="lead">Room No : {{ $data->roomno }}</p>
                        @if($data->hallscroll!=null)
                            <p class="lead">Hall Scroll NO : {{ $data->hallscroll }}</p>
                        @else
                            <p class="lead">Hall Scroll NO : Empty</p>
                        @endif
                        @if($data->bankscroll!=null)
                            <p class="lead">Bank Scroll NO : {{ $data->bankscroll }}</p>
                        @else
                            <p class="lead">Bank Scroll NO : Empty</p>
                        @endif
                        @if($data->receivedate!=null)
                            <p class="lead">Receive Date : {{ $data->receivedate }}</p>
                        @else
                            <p class="lead">Receive Date : Empty</p>
                        @endif
                        @if($data->fee!=null)
                            <p class="lead">Payment : {{ $data->fee }}</p>
                        @else
                            <p class="lead">Payment : Empty</p>
                        @endif
                        @if($data->remarks!=null)
                            <p class="lead">Remarks : {{ $data->remarks }}</p>
                        @else
                            <p class="lead">Remarks : Empty</p>
                        @endif
                        <p class="lead">Due : {{ $data->due }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizontal">
                        <dt>Create At:</dt>
                        <dd>{{ date('M j, Y h:ia', strtotime($data->created_at)) }}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y h:ia', strtotime($data->updated_at)) }}</dd>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('admin.editpayment',$data->id)}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        </div>
                        <div class="col-sm-6">
                            <a  class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.appall')


@section('content')
    <div class="container">
        @include('includes.delconfirmattached')
        @include('includes.sturepassword ')
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>{{ $data->name }} 's Data</h4></div>
                        <div class="panel-body">
                            <p class="lead">Name : {{ $data->name }}</p>
                            <p class="lead">Student Id : {{ $data->studentid }}</p>
                            <p class="lead">Department : {{ $data->department }}</p>
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
                            <a href="{{route('admin.editattached',$data->id)}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        </div>
                        <button type="button" class="btn btn-danger btn-block col-sm-5" data-toggle="modal" data-target="#confirm">
                            Delete
                        </button>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 col-md-offset-3">
                            <button type="button" class="btn btn-danger btn-block " data-toggle="modal" data-target="#reset">
                                Reset Password
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
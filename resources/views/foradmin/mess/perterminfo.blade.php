@extends('layouts.appall')


@section('content')
    <div class="container">
        @include('includes.delconfirmterm')
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Term No : {{ $data->termno }} 's Data</h5></div>
                    <div class="panel-body">
                        <p class="lead">Term No : {{ $data->termno }}</p>
                        <p class="lead">Started At : {{ $data->startat }}</p>
                        @if($data->finishat!=null)
                        <p class="lead">Finished At : {{ $data->finishat }}</p>
                        @else
                            <p class="lead">Finished At : Empty</p>
                        @endif
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
                            <a href="{{route('admin.openterm',$data->id)}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-folder-open"></span>  Open Mess</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{route('admin.editterm',$data->id)}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 col-md-offset-3">


                            <button type="button" class="btn btn-danger btn-block " data-toggle="modal" data-target="#confirm">
                                Delete
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
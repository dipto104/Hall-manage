@extends('layouts.appall')


@section('content')
    <div class="container">
        @include('includes.deldeleteroomreq')
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4> Room No : {{ $data->name }} 's Delete Request</h4></div>
                        <div class="panel-body">
                            <p class="lead">Room NO : {{ $data->roomno }}</p>
                            <p class="lead">Room Type : {{ $data->roomtype }}</p>
                            <p class="lead">Capacity : {{ $data->capacity }}</p>
                            <p class="lead">Number Of Students : {{ $data->occupy }}</p></div>
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
                            <a href="{{route('asstprovost.roomdeleteallow',$data->id)}}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Accept</a>
                        </div>
                        <button type="button" class="btn btn-danger btn-block col-sm-5" data-toggle="modal" data-target="#confirm">
                            Reject
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
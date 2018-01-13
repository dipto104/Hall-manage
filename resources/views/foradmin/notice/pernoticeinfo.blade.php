@extends('layouts.appall')


@section('content')
    <div class="container">
        @include('includes.delconfirmroom')
        <div class="row">
            <div class="col-md-8 ">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Notice Title: {{ $data->noticename }}</h5></div>
                    <form class="form-horizontal" method="POST" action="{{ route('admin.edittnotice.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="noticebody" class="col-md-4 control-label">Notice Description</label>

                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" id="noticebody" name="noticebody" disabled="disabled" value="{{ old('noticebody') }}" required autofocus></textarea>
                            </div>
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
                            <a href="{{route('admin.showeditroom',$data->id)}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        </div>
                        <button type="button" class="btn btn-danger btn-block col-sm-5" data-toggle="modal" data-target="#confirm">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
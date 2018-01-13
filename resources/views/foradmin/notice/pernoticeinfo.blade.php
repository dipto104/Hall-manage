@extends('layouts.appall')


@section('content')
    <div class="container">
        @include('includes.delconfirmnotice')
        <div class="row">
            <div class="col-md-8">
                <div class="card h-100">
                    <h4 class="card-header bg-info text-white">Notice Title : {{$data->noticename}}</h4>
                    <div class="card-body">
                        <ul>
                        <li><p class="card-text">Notice Description : {{$data->noticebody}}</p></li>
                            <li><p class="card-text">Notice Given By : {{$data->noticeby}}</p></li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="notices/{{$data->uniquefilename}}" download="notices/{{$data->uniquefilename}}" class="btn btn-primary">Download {{$data->givenfilename}}</a>
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
                            <a href="{{route('admin.editnotice',$data->id)}}" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
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
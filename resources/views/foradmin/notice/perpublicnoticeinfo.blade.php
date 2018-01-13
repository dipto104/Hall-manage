@extends('layouts.appall')


@section('content')
    <div class="container">
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
                        <a href="#" download class="btn btn-primary">Download</a>
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
                </div>
            </div>
        </div>
    </div>
@endsection
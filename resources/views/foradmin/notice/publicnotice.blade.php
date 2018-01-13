@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <h1>
                    All Notice
                 </h1>
            </div>

        </div>
        <div class="row">
            @foreach($data as $datum)
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <h4 class="card-header bg-info text-white">Notice Title : {{$datum->noticename}}</h4>
                            <div class="card-body">

                                    <ul>
                                        <li><p class="card-text">Notice Description : {{$datum->noticebody}}</p></li>

                                        <li><p class="card-text">Notice Given By : {{$datum->noticeby}}</p></li>
                                    </ul>

                                </div>
                            <div class="card-footer">
                                <a href="{{route('perpublicnotice',$datum->id)}}" class="btn btn-primary">View</a>
                            </div>
                            </div>
                        </div>

                    <!--<div class="col-md-6 col-md-offset-1">
                        <div class="panel panel-default">
                        <div class="panel-heading">Term No : {{$datum->termno}}</div>

                                <div class="panel-body">
                                    <p class="lead">Total Mess : {{$datum->totalmess}}</p>
                                    <p class="lead">Due : {{$datum->due}} /-taka</p>
                                    <p class="lead">Remarks : {{$datum->remarks}}</p>
                                </div>
                        </div>
                    </div>-->

            @endforeach
        </div>
        <div class="pagination">
            {!! $data->links(); !!}
        </div>

@endsection

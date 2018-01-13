@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <h1>
                    Due Status
                 </h1>
            </div>

        </div>
        <div class="row">
            @foreach($data as $datum)
                @if(!($datum->due==0))
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <h4 class="card-header bg-info text-white">Term No : {{$datum->termno}}</h4>
                            <div class="card-body">
                                <p class="lead">Total Mess : {{$datum->totalmess}}</p>
                                <p class="lead">Due : {{$datum->due}} /-taka</p>
                                <p class="lead">Remarks : {{$datum->remarks}}</p>
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
                @endif
            @endforeach
        </div>

@endsection

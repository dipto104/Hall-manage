@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="col-md-4 col-md-offset-1">

                    <h1>Due Status</h1>
                </div>
        </div>
        <div class="row">
            @foreach($data as $datum)
                @if(!($datum->due==0))
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                        <div class="panel-heading">Term No : {{$datum->termno}}</div>

                                <div class="panel-body">
                                    <p class="lead">Total Mess : {{$datum->totalmess}}</p>
                                    <p class="lead">Due : {{$datum->due}} /-taka</p>
                                    <p class="lead">Remarks : {{$datum->remarks}}</p>
                                </div>
                        </div>
                    </div>
                @endif
        </div>
            @endforeach
        </div>

@endsection

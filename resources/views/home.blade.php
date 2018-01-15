@extends('layouts.appall')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h4>{{$data->name}}'s Dashboard</h4></div>

                <div class="panel-body">
                    <!--@component('component.who')
                    @endcomponent
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif-->

                            <p class="lead">Name : {{ $data->name }}</p>
                            <p class="lead">Student ID : {{ $data->studentid }}</p>
                            <p class="lead">Department : {{ $data->department }}</p>
                            <p class="lead">Room NO : {{ $data->roomno }}</p>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

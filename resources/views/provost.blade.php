@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Provost Dashboard</h3></div>

                    <div class="panel-body">
                    <!--@component('component.who')
                    @endcomponent
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                                </div>
                            @endif-->

                            <p class="lead">Name : {{ Auth::user()->name }}</p>
                            <p class="lead">Post : Provost</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

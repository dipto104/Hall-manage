@extends('layouts.appall')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-md-10 col-md-offset-4">
                            <h1>Dining Payment</h1>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.insertterm') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Term</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Current Term</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Current Mess</a>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.termdata') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">All Term List</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Mess</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Mess</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

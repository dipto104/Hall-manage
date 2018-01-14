@extends('layouts.appall')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-md-10 col-md-offset-4">
                            <h1>Term No : {{$data->termno}} Mess</h1>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.createmess',$data->termno) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Mess</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.termduecal',$data->id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Calculate Due </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.termdueshow',$data->id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Show Due List</a>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.messdata',$data->termno) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Mess List Of This Term</a>
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

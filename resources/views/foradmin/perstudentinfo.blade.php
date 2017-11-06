@extends('layouts.appall')


@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $data->id }}</h1>

            <p class="lead">Name : {{ $data->name }}</p>
            <p class="lead">Student Id : {{ $data->studentid }}</p>
        </div>
    </div>
@endsection
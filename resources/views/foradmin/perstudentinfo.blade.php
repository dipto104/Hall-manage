@extends('layouts.appall')


@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $data->id }}</h1>

            <p class="lead">{{ $data->name }}</p>
        </div>
    </div>
@endsection
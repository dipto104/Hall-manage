@extends('layouts.appall')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Student Dashboard</div>

                <div class="panel-body">
                    @component('component.who')
                    @endcomponent
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                            <div class="col-sm-6">
                                <a href="{{route('student.duestatus',$data->id)}}" class="btn btn-primary btn-block"> Due Status</a>
                            </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection

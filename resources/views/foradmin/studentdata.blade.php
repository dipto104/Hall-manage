@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-4">
            <h1>Students Data</h1>
        </div>


        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Student ID</th>
                <th>Password</th>
                <th>Created At</th>
                <th></th>
                </thead>

                <tbody>

                @foreach ($data as $studentdata)

                    <tr>
                        <th>{{ $studentdata->id }}</th>
                        <th>{{ $studentdata->name }}</th>
                        <td>{{ $studentdata->email }}</td>
                        <td>{{ $studentdata->password}}</td>
                        <td>{{ date('M j, Y', strtotime($studentdata->created_at)) }}</td>

                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
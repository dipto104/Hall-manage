@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-4">
            <h1>Students Data</h1>
        </div>

        <div class="col-md-2 col-md-offset-10">
            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">InsertStudent</a>
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
                <th>Created At</th>
                <th></th>
                </thead>

                <tbody>

                @foreach ($data as $studentdata)

                    <tr>
                        <th>{{ $studentdata->id }}</th>
                        <th>{{ $studentdata->name }}</th>
                        <td>{{ $studentdata->studentid }}</td>
                        <td>{{ date('M j, Y', strtotime($studentdata->created_at)) }}</td>
                        <td><a href="{{ route('admin.perstudent', $studentdata->id) }}" class="btn btn-default btn-sm">View</a>
                            <a href="{{ route('admin.editstudent',$studentdata->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
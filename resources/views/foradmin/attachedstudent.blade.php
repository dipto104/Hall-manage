@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Attached Students Data</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>

        <div class="col-md-2">
            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">InsertStudent</a>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('admin.importstudent') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="col-md-10" >
                    <p>Insert Excel File Here
                    <input  type="file" class="form-control" name="file">
                    <input type="submit" value="import" class="btn btn-success">
                        <span class="alert-danger">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    </p>
                </div>

        </form>

        <div class="col-md-2">
            <a href="{{ route('admin.exportstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Download</a>
        </div>

        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->

    <table class="table table-bordered" id="users-table">
        <thead class="bg-info text-white">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Student ID</th>
            <th>Department</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.studentdatashow') !!}',
                columns: [
                    {data:'id',name:'id'},
                    { data: 'name', name: 'name' },
                    { data: 'studentid', name: 'studentid' },
                    { data: 'department', name: 'department' },
                    { data: 'roomno', name: 'roomno' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
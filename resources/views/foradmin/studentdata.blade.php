@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Students Data</h1>
        </div>

        <div class="col-md-2 col-md-offset-2">
            <a href="{{ route('admin.insertstudent') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">InsertStudent</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->

    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Student ID</th>
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
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
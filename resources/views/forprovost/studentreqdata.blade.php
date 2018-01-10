@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Students Insert Request</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
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
            <th>Department</th>
            <th>Room NO</th>
            <th>Student Type</th>
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
                ajax: '{!! route('provost.studentreqinsert') !!}',
                columns: [
                    {data:'id',name:'id'},
                    { data: 'name', name: 'name' },
                    { data: 'studentid', name: 'studentid' },
                    { data: 'department', name: 'department' },
                    { data: 'roomno', name: 'roomno' },
                    { data: 'studenttype', name: 'studenttype' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
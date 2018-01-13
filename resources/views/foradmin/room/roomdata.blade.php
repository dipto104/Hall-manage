@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Room Data</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>

        <form class="form-horizontal" method="POST" action="{{ route('admin.importroom') }}" enctype="multipart/form-data">
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
            <th>Room No</th>
            <th>Room Type</th>
            <th>Capacity</th>
            <th>Number of Student</th>
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
                ajax: '{!! route('admin.roomdatashow') !!}',
                columns: [
                    {data:'id',name:'id'},
                    { data: 'roomno', name: 'roomno' },
                    { data: 'roomtype', name: 'roomtype' },
                    { data: 'capacity', name: 'capacity', orderable: false, searchable: false},
                    { data: 'occupy', name: 'occupy', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
@extends('layouts.appall')
@section('content')
    @include('includes.deldeleteroomreqall')
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Room Delete Request</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-2">
            <a href="{{ route('asstprovost.roomdeleteallowall') }}" class="btn btn-lg btn-block btn-success btn-h1-spacing">Accept All</a>
        </div>
        <div  class="col-md-4">
            <button type="button" class="btn btn-lg btn btn-danger btn-block col-sm-5" data-toggle="modal" data-target="#confirm">
                Reject All
            </button>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->

    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Room NO</th>
            <th>Room Type</th>
            <th>Capacity</th>
            <th>Number Of Student</th>
            <th>Created AT</th>
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
                ajax: '{!! route('asstprovost.roomreqdelete') !!}',
                columns: [
                    {data:'id',name:'id'},
                    { data: 'roomno', name: 'roomno' },
                    { data: 'roomtype', name: 'roomtype' },
                    { data: 'capacity', name: 'capacity' , orderable: false, searchable: false},
                    { data: 'occupy', name: 'occupy' , orderable: false, searchable: false},
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
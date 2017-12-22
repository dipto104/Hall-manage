@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>All Term Data</h1>
        </div>


        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->

    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Term NO</th>
            <th>Started At</th>
            <th>Finished At</th>
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
                ajax: '{!! route('admin.termdatashow') !!}',
                columns: [
                    {data:'id',name:'id',searchable: false},
                    { data: 'termno', name: 'termno' },
                    { data: 'startat', name: 'startat',searchable: false },
                    { data: 'finishat', name: 'finishat',searchable: false },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
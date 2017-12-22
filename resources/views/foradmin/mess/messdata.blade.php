@extends('layouts.appall')
@section('content')

    <div class="row">

        <div class="col-md-5 col-md-offset-4">
            <h1>Term No : All Mess List</h1>
        </div>


        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->




                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Mess No</th>
                        <th>Started At</th>
                        <th>Finished At</th>
                        <th>Mess Payment</th>
                        <th>Hall Payment</th>
                        <th>Fine Rate</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
                @stop

                @push('scripts')
                    <script>
                        var table;
                        $(function() {
                            table=$('#users-table').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: '{!! route('admin.messdatashow') !!}',
                                columns: [
                                    {data:'id',name:'id',searchable: false},
                                    { data: 'messno', name: 'messno' },
                                    { data: 'startat', name: 'startat',searchable: false },
                                    { data: 'finishat', name: 'finishat',searchable: false },
                                    {data:'messfee',name:'messfee',searchable: false},
                                    {data:'extrafee',name:'extrafee',searchable: false},
                                    {data:'fine',name:'fine',searchable: false},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                ]
                            });
                        });
                    </script>
    @endpush
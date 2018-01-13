@extends('layouts.appall')
@section('content')

    <div class="row">
        @if($data!=null)
            <div class="col-md-5 col-md-offset-4">

                    <h1>Term No :{{$data[0]->termno}} | All Mess List</h1>

            </div>
        @else
            <div class="col-md-6 col-md-offset-3 alert-danger">
                <h1>No Mess Data In This Term</h1>
            </div>
        @endif

        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->




                <table class="table table-bordered" id="users-table">
                    <thead class="bg-info text-white">
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
                        var url;
                        url = '{{ route('admin.messdatashow', (!empty($data) ) ? $data[0]->termno : -1000 ) }}';
                        $(function() {
                            table=$('#users-table').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: url,
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
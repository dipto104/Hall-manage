@extends('layouts.appall')
@section('content')

    <<div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h1>Term No :{{$data[0]->termno}} | Mess NO :{{$data[0]->messno}}</h1>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <a href=" {{route('admin.duemess',$data[0]->id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Calculate Due</a>
        </div>

        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->

                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Room NO</th>
                        <th>Hall Scroll NO</th>
                        <th>Bank Scroll NO</th>
                        <th>Receive Date</th>
                        <th>Payment</th>
                        <th>Remarks</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
                @stop

                @push('scripts')
                    <script>
                        var table;
                        var url='{{ route('admin.showpayment', $data[0]->messno) }}';
                        $(function() {
                            table=$('#users-table').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax:url,
                                columns: [
                                    {data:'id',name:'id',searchable: false},
                                    { data: 'studentid', name: 'studentid' },
                                    { data: 'name', name: 'name',searchable: false },
                                    { data: 'department', name: 'department' },
                                    {data:'roomno',name:'roomno'},
                                    {data:'hallscroll',name:'hallscroll',searchable: false},
                                    {data:'bankscroll',name:'bankscroll',searchable: false},
                                    {data:'receivedate',name:'receivedate',searchable: false},
                                    {data:'fee',name:'fee',searchable: false},
                                    {data:'remarks',name:'remarks',searchable: false},
                                    {data:'due',name:'due',searchable: false},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                ]
                            });
                        });
                    </script>
    @endpush
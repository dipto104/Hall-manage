@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-4">
            <h1>Term No :{{$data[0]->termno}} | Mess NO :{{$data[0]->messno}}</h1>
        </div>
        <div class="col-md-3 col-md-offset-1">
            <a href="{{ route('admin.duemess',$data[0]->id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Calculate Due</a>
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
                <th>Student ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Room NO</th>
                <th>Hall Scroll NO</th>
                <th>Bank Scroll NO</th>
                <th>Receive Date</th>
                <th>Remarks</th>
                <th>Due</th>
                </thead>

                <tbody>


                @foreach ($data as $messdata)

                    <tr>
                        <th>{{ $messdata->id }}</th>
                        <th>{{ $messdata->studentid }}</th>
                        <th>{{ $messdata->name }}</th>
                        <th>{{ $messdata->department }}</th>
                        <th>{{ $messdata->roomno }}</th>
                        <th>{{ $messdata->hallscroll }}</th>
                        <th>{{ $messdata->bankscroll }}</th>
                        @if($messdata->receivedate!=null)
                            <td>{{ date('M j, Y', strtotime($messdata->receivedate)) }}</td>
                        @else
                            <td>Empty</td>
                        @endif
                        <th>{{ $messdata->remarks }}</th>
                        <th>{{ $messdata->due }}</th>
                        <td><a href="{{ route('admin.openterm', $messdata->id) }}" class="btn btn-default btn-sm">Open</a>
                            <a href="{{ route('admin.editpayment',$messdata->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
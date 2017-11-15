@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-4">
            <h1>Term No {{$data[0]->termno}} : All Mess List</h1>
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
                <th>Mess No</th>
                <th>Started At</th>
                <th>Finished At</th>
                <th>Vacation started At</th>
                <th>Vacation finished At</th>
                <th>Mess Payment</th>
                <th>Hall Payment</th>
                <th>Fine Rate</th>
                <th></th>
                </thead>

                <tbody>


                @foreach ($data as $messdata)

                    <tr>
                        <th>{{ $messdata->id }}</th>
                        <th>{{ $messdata->messno }}</th>
                        <td>{{ date('M j, Y', strtotime($messdata->startat)) }}</td>
                        <td>{{ date('M j, Y', strtotime($messdata->finishat)) }}</td>
                        @if($messdata->vacstartat!=null)
                            <td>{{ date('M j, Y', strtotime($messdata->vacstartat)) }}</td>
                        @else
                            <td>Empty</td>
                        @endif
                        @if($messdata->vacfinishat!=null)
                            <td>{{ date('M j, Y', strtotime($messdata->vacfinishat)) }}</td>
                        @else
                            <td>Empty</td>
                        @endif
                        <th>{{ $messdata->messfee }}</th>
                        @if($messdata->extrafee!=null)
                            <td>{{$messdata->extrafee}}</td>
                        @else
                            <td>Empty</td>
                        @endif
                        <th>{{ $messdata->fine }}</th>
                        <td><a href="{{ route('admin.openpayment', $messdata->id) }}" class="btn btn-default btn-sm">Open</a>
                            <a href="{{ route('admin.editmess',$messdata->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
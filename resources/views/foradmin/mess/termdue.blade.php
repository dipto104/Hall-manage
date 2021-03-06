@extends('layouts.appall')
@section('content')
    @if($datatermdue==null)
        <div class="col-md-6 col-md-offset-3 alert-danger">
            <h1>No Mess Data In This Term</h1>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 col-md-offset-4">
                <h1>Term No {{$datatermdue[0]->termno}} : Due List</h1>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row"><!-- end of .row -->
            <div class="col-md-2">
                <a href="{{ route('admin.exporttermdue',$datatermdue[0]->termno) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Download</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="bg-info text-white">
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Room NO</th>
                    <th>Total Mess</th>
                    <th>Due Payment</th>
                    <th>Remarks</th>
                    <th></th>
                    </thead>

                    <tbody>


                    @foreach ($datatermdue as $messdata)

                        <tr>
                            <td>{{ $messdata->id }}</td>
                            <td>{{ $messdata->studentid }}</td>
                            <td>{{ $messdata->name }}</td>
                            <td>{{ $messdata->roomno }}</td>
                            <th>{{ $messdata->totalmess }}</th>
                            @if($messdata->due!=null)
                                <td>{{$messdata->due}}</td>
                            @else
                                <td>Cleared</td>
                            @endif
                            <th>{{ $messdata->remarks }}</th>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
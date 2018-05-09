@extends('layouts.appall')
@section('content')
    @if($freeroom==null)
        <div class="col-md-6 col-md-offset-3 alert-danger">
            <h1>No FREE ROOM Available</h1>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 col-md-offset-4">
                <h1>Free Room Data</h1>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row"><!-- end of .row -->
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="bg-info text-white">
                    <th>Id</th>
                    <th>Room No</th>
                    <th>Room Type</th>
                    <th>Capacity</th>
                    <th>Number of Student</th>
                    </thead>
                    <tbody>


                    @foreach ($freeroom as $room)

                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->roomno }}</td>
                            <td>{{ $room->roomtype }}</td>
                            <td>{{ $room->capacity }}</td>
                            <th>{{ $room->occupy }}</th>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
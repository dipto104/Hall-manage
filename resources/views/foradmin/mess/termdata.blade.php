@extends('layouts.appall')
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-4">
            <h1>All Term Data</h1>
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
                <th>Term No</th>
                <th>Started At</th>
                <th>Finished At</th>
                <th></th>
                </thead>

                <tbody>


                @foreach ($data as $termdata)

                    <tr>
                        <th>{{ $termdata->id }}</th>
                        <th>{{ $termdata->termno }}</th>
                        <td>{{ date('M j, Y', strtotime($termdata->startat)) }}</td>
                        @if($termdata->finishat!=null)
                            <td>{{ date('M j, Y', strtotime($termdata->finishat)) }}</td>
                        @else
                            <td>Empty</td>
                        @endif
                        <td><a href="{{ route('admin.openterm', $termdata->id) }}" class="btn btn-default btn-sm">Open</a>
                            <a href="{{ route('admin.editterm',$termdata->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
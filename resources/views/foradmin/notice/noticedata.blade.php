@extends('layouts.appall')
@section('content')
    @if($data==null)
        <div class="col-md-6 col-md-offset-3 alert-danger">
            <h1>No Notice For Show</h1>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 col-md-offset-4">
                <h1>Notice Moderation</h1>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <th>Notice Title</th>
                    <th>Notice Description</th>
                    <th>Notice Given By</th>
                    <th>Action</th>
                    <th></th>
                    </thead>

                    <tbody>


                    @foreach ($data as $singledata)

                        <tr>
                            <td>{{ str_limit($singledata->noticename, $limit = 15, $end = '...') }}</td>
                            <td>{{ str_limit($singledata->noticebody, $limit = 15, $end = '...') }}</td>
                            <td>{{ $singledata->noticeby }}</td>


                            <td><a href="{{ route('admin.openpayment', $singledata->id) }}" class="btn btn-primary btn-sm">Open</a>
                                <a href="{{ route('admin.editmess',$singledata->id) }}" class="btn btn-secondary btn-sm">Edit</a></td>
                        </tr>


                    @endforeach

                    </tbody>
                </table>
                <div class="pagination">
                    {!! $data->links(); !!}
                </div>
            </div>
        </div>
    @endif

@endsection
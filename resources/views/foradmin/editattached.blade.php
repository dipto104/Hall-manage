@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-.5">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3p>Edit Attached Student Data</h3p></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('admin.updateattached',$data->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="alert-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('studentid') ? ' has-error' : '' }}">
                                <label for="studentid" class="col-md-4 control-label">Student ID</label>

                                <div class="col-md-6">
                                    <input id="studentid" type="text" class="form-control" name="studentid" value="{{ $data->studentid }}" required autofocus>

                                    @if ($errors->has('studentid'))
                                        <span class="alert-danger">
                                        <strong>{{ $errors->first('studentid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-4 control-label">Department</label>

                                <div class="col-md-6">
                                    <input id="department" type="text" class="form-control" name="department" value="{{ $data->department }}" required>

                                    @if ($errors->has('department'))
                                        <span class="alert-danger">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-4 ">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Save Changes
                                    </button>
                                </div>
                                <div class="col-md-3 ">
                                    <a href="{{route('admin.perstudent',$data->id)}}" class="btn btn-danger btn-block">Cancel</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizontal">
                        <dt>Created At:</dt>
                        <dd>{{ date('M j, Y h:ia', strtotime($data->created_at)) }}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y h:ia', strtotime($data->updated_at)) }}</dd>
                    </dl>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection

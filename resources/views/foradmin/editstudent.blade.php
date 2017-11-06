@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Student Data</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('admin.updatestudent',$data->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
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
                                        <span class="help-block">
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
                                        <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('roomno') ? ' has-error' : '' }}">
                                <label for="roomno" class="col-md-4 control-label">Room No</label>

                                <div class="col-md-6">
                                    <input id="roomno" type="text" class="form-control" name="roomno" value="{{ $data->roomno }}" required>

                                    @if ($errors->has('roomno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('roomno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
                                <label for="userid" class="col-md-4 control-label">User ID</label>

                                <div class="col-md-6">
                                    <input id="userid" type="text" class="form-control" name="userid" value="{{ $data->userid}}" required>

                                    @if ($errors->has('userid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

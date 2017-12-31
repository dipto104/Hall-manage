@extends('layouts.appall')
@section('content')
<div class="container">
    <div class="row main">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h5>Room Entry</h5></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.insertroom') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('roomno') ? ' has-error' : '' }}">
                                <label for="roomno" class="col-md-4 control-label">Room NO</label>

                                <div class="col-md-6">
                                    <input id="roomno" type="text" class="form-control" name="roomno" value="{{ old('roomno') }}" required autofocus>

                                    @if ($errors->has('roomno'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('roomno') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('roomtype') ? ' has-error' : '' }}">
                                <label for="roomtype" class="col-md-4 control-label">Room Type</label>

                                <div class="col-md-6">
                                    <input id="roomtype" type="text" class="form-control" name="roomtype" value="{{ old('roomtype') }}" required autofocus>

                                    @if ($errors->has('roomtype'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('roomtype') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-4 control-label">Capacity</label>

                                <div class="col-md-6">
                                    <input id="capacity" type="text" class="form-control" name="capacity" value="{{ old('capacity') }}" required autofocus>

                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('capacity') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Insert
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
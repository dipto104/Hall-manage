@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h1>Term NO :{{$data->termno}}</h1>
                    <div class="panel-heading">Edit Mess No : {{$data->messno}}</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.editmess.submit',$data->id) }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('messno') ? ' has-error' : '' }}">
                                <label for="messno" class="col-md-4 control-label">Mess NO</label>

                                <div class="col-md-6">
                                    <input id="messno" type="text" class="form-control" name="messno" value="{{ $data->messno }}" required autofocus>

                                    @if ($errors->has('messno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('messno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('startat') ? ' has-error' : '' }}">
                                <label for="startat" class="col-md-4 control-label">Starts At</label>

                                <div class="col-md-6">
                                    <input id="startat" type="date" class="form-control" name="startat" value="{{ $data->startat }}" required>

                                    @if ($errors->has('startat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('startat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('finishat') ? ' has-error' : '' }}">
                                <label for="finishat" class="col-md-4 control-label">Finish At</label>

                                <div class="col-md-6">
                                    <input id="finishat" type="date" class="form-control" name="finishat" value="{{ $data->finishat }}"required>

                                    @if ($errors->has('finishat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('finishat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('vacnumber') ? ' has-error' : '' }}">
                                <label for="vacnumber" class="col-md-4 control-label">Number Of Vacation</label>

                                <div class="col-md-6">
                                    <input id="vacnumber" type="text" class="form-control" name="vacnumber" value="{{$data->vacnumber }}" >

                                    @if ($errors->has('vacnumber'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('vacnumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('messfee') ? ' has-error' : '' }}">
                                <label for="messfee" class="col-md-4 control-label">Mess Payment (-/taka)</label>

                                <div class="col-md-6">
                                    <input id="messfee" type="text" class="form-control" name="messfee" value="{{$data->messfee }}" required>

                                    @if ($errors->has('messfee'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('messfee') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('extrafee') ? ' has-error' : '' }}">
                                <label for="extrafee" class="col-md-4 control-label">Hall Payment (-/taka)</label>

                                <div class="col-md-6">
                                    <input id="extrafee" type="text" class="form-control" name="extrafee" value="{{$data->extrafee }}" >

                                    @if ($errors->has('extrafee'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('extrafee') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fine') ? ' has-error' : '' }}">
                                <label for="fine" class="col-md-4 control-label">Fine (-/taka)</label>

                                <div class="col-md-6">
                                    <input id="fine" type="text" class="form-control" name="fine" value="{{ $data->fine }}" required>

                                    @if ($errors->has('fine'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fine') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-4">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Save Changes
                                    </button>
                                </div>
                                <hr>
                                <div class="col-md-3">
                                    <a class="btn btn-danger btn-block" href="{{ route('admin.hallmess') }}">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

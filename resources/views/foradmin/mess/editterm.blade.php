@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Term No:{{$data->termno}}</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.editterm.submit',$data->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('termno') ? ' has-error' : '' }}">
                                <label for="termno" class="col-md-4 control-label">Term NO</label>

                                <div class="col-md-6">
                                    <input id="termno" type="text" class="form-control" name="termno" value="{{$data->termno }}" required autofocus>

                                    @if ($errors->has('termno'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('termno') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('startat') ? ' has-error' : '' }}">
                                <label for="startat" class="col-md-4 control-label">Starts At</label>

                                <div class="col-md-6">
                                    <input id="startat" type="date" class="form-control" name="startat" value="{{$data->startat}}" required>

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
                                    <input id="finishat" type="date" class="form-control" name="finishat" value="{{$data->finishat}}" >

                                    @if ($errors->has('finishat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('finishat') }}</strong>
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

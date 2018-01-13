@extends('layouts.appall')
@section('content')
<div class="container">
    <div class="row main">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> <h5>Compose Notice</h5></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.insertnotice.submit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('noticename') ? ' has-error' : '' }}">
                                <label for="noticename" class="col-md-4 control-label">Notice Title</label>

                                <div class="col-md-10">
                                    <input id="noticename" type="text" class="form-control" name="noticename" value="{{ old('noticename') }}" required autofocus>

                                    @if ($errors->has('noticename'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('noticename') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('noticebody') ? ' has-error' : '' }}">
                                <label for="noticebody" class="col-md-4 control-label">Notice Description</label>

                                <div class="col-md-10">
                                    <textarea class="form-control" rows="5" id="noticebody" name="noticebody" value="{{ old('noticebody') }}" required autofocus></textarea>

                                    @if ($errors->has('noticebody'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('noticebody') }}</strong>
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
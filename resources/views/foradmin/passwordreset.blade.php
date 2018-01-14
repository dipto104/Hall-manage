@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Change Password</h4></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.changepass') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('oldpass') ? ' has-error' : '' }}">
                                <label for="oldpass" class="col-md-4 control-label">Old Password</label>

                                <div class="col-md-6">
                                    <input id="oldpass" type="password" class="form-control" name="oldpass" required>

                                    @if ($errors->has('oldpass'))
                                        <span class="alert-danger">
                                        <strong>{{ $errors->first('oldpass') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="alert-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success col-md-9 col-md-offset-4">
                                        Save
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

@extends('layouts.appall')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Student Payment</div>
                    <h3>Name : {{$data->name}}</h3>
                    <h3>Student ID : {{$data->studentid}}</h3>
                    <h3>Department : {{$data->department}}</h3>
                    <h3>Room NO : {{$data->roomno}}</h3>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('admin.editpayment.submit',$data->id)}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('hallscroll') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Hall Scroll NO</label>

                                <div class="col-md-6">
                                    <input id="hallscroll" type="text" class="form-control" name="hallscroll" value="{{ $data->hallscroll }}" required autofocus>

                                    @if ($errors->has('hallscroll'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('hallscroll') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('bankscroll') ? ' has-error' : '' }}">
                                <label for="bankscroll" class="col-md-4 control-label">Bank Scroll NO</label>

                                <div class="col-md-6">
                                    <input id="bankscroll" type="text" class="form-control" name="bankscroll" value="{{ $data->bankscroll }}" required autofocus>

                                    @if ($errors->has('bankscroll'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bankscroll') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('receivedate') ? ' has-error' : '' }}">
                                <label for="receivedate" class="col-md-4 control-label">Receive Date</label>

                                <div class="col-md-6">
                                    <input id="receivedate" type="date" class="form-control" name="receivedate" value="{{ $data->receivedate }}" required>

                                    @if ($errors->has('receivedate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('receivedate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
                                <label for="fee" class="col-md-4 control-label">Payment(-/taka)</label>

                                <div class="col-md-6">
                                    <input id="rfee" type="text" class="form-control" name="fee" value="{{ $data->fee }}" required>

                                    @if ($errors->has('fee'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fee') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                                <label for="remarks" class="col-md-4 control-label">Remarks</label>

                                <div class="col-md-6">
                                    <input id="remarks" type="text" class="form-control" name="remarks" value="{{ $data->remarks }}" required>

                                    @if ($errors->has('remarks'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('remarks') }}</strong>
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
                                    <a href="{{route('admin.openpayment', $data->id)}}" class="btn btn-danger btn-block">Cancel</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

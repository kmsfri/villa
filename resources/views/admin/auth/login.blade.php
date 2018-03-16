@extends('admin.master-login')
@section('content')
<div class="container">
    <div class="row" style="margin-top:100px">
        <div class=".col-sm-5 col-md-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">ورود به پنل مدیریت</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ Route('do-admin-login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-3 pull-right control-label">نام کاربری</label>
                            <div class="col-md-7 pull-right">
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}">
                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 pull-right control-label">کلمه عبور</label>

                            <div class="col-md-7 pull-right">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; مرا به یاد داشته باش
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> ورود به پنل
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

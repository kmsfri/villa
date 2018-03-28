<!DOCTYPE html>
<html>
<head>
    <title>ورود</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('users/bs4/scss/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('users/css/normalize.css')}}" rel="stylesheet">
    <link href="{{asset('users/css/style.css')}}" rel="stylesheet">

</head>
<body>
<main class="login">
    <section class="login">
        <div class="container">
            <div class="row justify-content-md-center align-items-center">
                <div class="col-md-4">
                    <div class="box-login">
                        <div class="text-center"><img src="{{asset('users/img/icon-login.jpg')}}">
                            <h1 class="title">ورود</h1>

                            @if( Session::has('data') )
                                <span class="help-block" style="background: #fff;color:red;"> {{ Session::get('data') }} </span>
                            @endif

                        </div>
                        <form method="POST" action="{{route('login')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control right" name="phone" value="{{ old('phone') }}" min="10" max="11" type="text" placeholder="شماره همراه مثال(09120000000)" required autofocus>
                                        @if ($errors->has('phone')) <span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span> @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control right" name="password" value="" type="password" placeholder="رمز عبور" required>
                                        @if ($errors->has('password')) <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span> @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" style="font-size: 12px;">
                                        <input type="checkbox" name="remember"> مرا به یاد داشته باش
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button class="btn btn-success float-left"><i class="mdi mdi-check"></i>ورود</button><a class="btn btn-outline-secondary" href="{{route('showregister')}}"><i class="mdi mdi-account-plus"></i>ثبت نام</a>
                            <div class="clearfix"></div>
                            <a href="{{route('showpassword')}}" style="font-size: 12px;">رمز عبور خود را فراموش کرده اید؟</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>ثبت نام</title>
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
                            <h1 class="title">ثبت نام</h1>
                            @if( Session::has('data') )
                                <span class="help-block" style="background: #fff;color:red;"> {{ Session::get('data') }} </span>
                            @endif
                        </div>
                        <form method="POST" action="">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control right" name="phone" value="{{ old('phone') }}" min="10" max="11" type="text" placeholder="شماره همراه" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button class="btn btn-success float-left"><i class="mdi mdi-check"></i>ثبت نام</button><a class="btn btn-outline-secondary" href="#"><i class="mdi mdi-account-plus"></i>قبلا ثبت نام کرده اید؟</a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
<!DOCTYPE html>
<html lang="fa">
<head>
  <link rel="icon" href="{!! asset('admin/uploads/static/fav.png') !!}" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>پنل مدیریت</title>
  <script type="text/javascript" src="{!! asset('admin/bootstrap-3.3.7/js/jquery.min.js') !!}"></script>
  <link href="{!! asset('admin/css/bootstrap.min.css') !!}" rel="stylesheet">
  <script type="text/javascript" src="{!! asset('admin/bootstrap-3.3.7/js/bootstrap.min.js') !!}"></script>
  <link href="{!! asset('admin/css/sb-admin-2.css') !!}" rel="stylesheet">
  <link href="{!! asset('admin/css/font-awesome/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('cssFiles')
  @yield('jsFiles')
</head>
<body>
<div id="wrapper">
    @include('admin.common.header')
    @if(session('messages'))
      <div class="row submit-messages">
        <ul>
            @foreach(session('messages') as $msg)
                <li>{{$msg}}</li>
            @endforeach
        </ul>
      </div>
    @endif
    @yield('content')
</div>
</body>
</html>
<script type="text/javascript" src="{!! asset('admin/js/jquery-1.11.0.js') !!}"></script>
<script type="text/javascript" src="{!! asset('admin/js/bootstrap.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('admin/js/metisMenu/metisMenu.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('admin/js/sb-admin-2.js') !!}"></script>
@yield('jsCustom')
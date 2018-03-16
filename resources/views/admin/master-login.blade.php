<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>پنل مدیریت</title>
  <script type="text/javascript" src="{!! asset('admin/bootstrap-3.3.7/js/jquery.min.js') !!}"></script>
  <link href="{!! asset('admin/bootstrap-3.3.7/css/bootstrap-theme.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{!! asset('admin/bootstrap-3.3.7/js/bootstrap.min.js') !!}"></script>
  <link href="{!! asset('admin/bootstrap-3.3.7/css/bootstrap.min.css') !!}" media="all" rel="stylesheet" type="text/css" />
  <link href="{!! asset('admin/css/admin_custom.css') !!}" media="all" rel="stylesheet" type="text/css" />
  @yield('cssFiles')
  @yield('jsFiles')
</head>
<body id="app-layout " >
    @yield('content')
    <footer>
        @yield('footer')
    </footer>
</body>
</html>
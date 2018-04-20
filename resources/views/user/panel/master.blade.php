<!DOCTYPE html>
<html>
  <head>
    <title>پنل کاربری{{isset($page_title)?' - '.$page_title:''}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- My Style -->
    <link href="{{asset('users/bs4/scss/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/rating/star-rating-svg.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/font-awesome/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('users/js/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('users/css/normalize.css')}}" rel="stylesheet">
    <link href="{{asset('users/css/style.css')}}" rel="stylesheet">
	<script src="{{asset('users/js/jquery.min.js')}}"></script>
  </head>
  <body>
    <main>
      <aside class="sidebar">
        <div class="headera">
		<a class="logo" href="" alt=""><img src="{{asset('users/img/logo.png')}}" alt=""></a><a class="link-mobile d-md-none d-inline-block" href="" alt=""><img src="{{asset('users/img/icon/icon0108.png')}}" alt=""></a></div>
        <div class="box-user"><img src="{{asset('images/users/user-uploads/user-pics/'.$user->avatar_dir)}}" alt="">
          <p>{{$user->fullname}}</p><span class="points">امتیاز شما : {{$user->points }}</span>
        </div>
        <ul class="ul-sidebar">
          <li><a href="{{route('showdashboard')}}" title=""><img src="{{asset('users/img/icon/icon040.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon040-2.png')}}" alt=""><span>پیشخوان</span></a></li>
          <li class="subset"><a href="" title="" data-toggle="collapse" data-target="#ul-list1" aria-expanded="false"><img src="{{asset('users/img/icon/icon041.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon041-2.png')}}" alt=""><span>ملک های من</span></a>
            <ul class="list-subset collapse" id="ul-list1">
              <li><a href="" title="ثبت ملک جدید  "> ثبت ملک جدید</a></li>
              <li><a href="{{Route('villaList')}}" title="ویلا ها  ">ویلا ها</a></li>
              <li><a href="" title="سوئیت - آپارتمان ها  ">سوئیت - آپارتمان ها</a></li>
              <li><a href="" title="اقامتگاه های بوم گردی  ">اقامتگاه های بوم گردی</a></li>
            </ul>
          </li>
          <!--
          <li><a href="" title=""><img src="{{asset('users/img/icon/icon042.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon042-2.png')}}" alt=""><span>ارتباط با مهمانان</span></a></li>
          <li><a href="" title=""><img src="{{asset('users/img/icon/icon045.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon045-2.png')}}" alt=""><span>امور مالی</span></a></li>
          -->
          <li><a href="{{route('contents')}}" title=""><img src="{{asset('users/img/icon/icon043.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon043-2.png')}}" alt=""><span>گردشگری</span></a></li>
          <li><a href="{{route('showblog')}}" title=""><img src="{{asset('users/img/icon/icon045.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon045-2.png')}}" alt=""><span>وبلاگ من</span></a></li>
          <li><a href="{{Route('ticketList')}}" title=""><img src="{{asset('users/img/icon/icon044.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon044-2.png')}}" alt=""><span>پیام ها</span></a></li>
          <li><a href="{{route('showuser')}}" title=""><i class="fa fa-user" style="font-size: 25px;"></i> <span>ویرایش اطلاعات</span></a></li>
          <li><a href="{{route('logout')}}" title=""><i class="fa fa-unlock" style="font-size: 25px;"></i> <span>خروج از سیستم</span></a></li>
        </ul>
      </aside>
      <div class="main-panel">
      @include('user.panel.common.heading')
      @yield('main')
      </div>
    </main>
    <script src="{{asset('users/js/popover.js')}}"></script>
    <script src="{{asset('users/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('users/js/tether.min.js')}}"></script>
    @yield('mapscript')
    <script>
      $(document).ready(function () {
          $(".link").click(function (e) {
              $(".sidebar ").toggleClass('show');
              e.preventDefault();
              e.stopPropagation();
          });
          $(".link-mobile").click(function (e) {
              $(".sidebar ").toggleClass('show');
              e.preventDefault();
              e.stopPropagation();
          });
      
          $('[data-toggle="tooltip"]').tooltip()
      });
    </script>
    <!--end scripts-->
  </body>
</html>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>ویلایار{{(!empty($meta) && $meta->title!=Null)?' - '.$meta->title:''}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@if(!empty($meta))
@foreach($meta as $key=>$m)
    <meta name="{{$key}}" content="{{$m}}">
@endforeach
@endif
    {!!(isset($canonical_url))?'<link rel="canonical" href="'.$canonical_url.'">':''!!}
@if(!empty($openGraph))
@foreach($openGraph as $key=>$og)
    <meta property="og:{{$key}}" content="{{$og}}">
@endforeach
@endif
    <link href="{{asset('users/bs4/scss/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/rating/star-rating-svg.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/font-awesome/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('users/plugin/datepicker//bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('users/css/normalize.cs')}}" rel="stylesheet">
    <link href="{{asset('users/css/style.css')}}" rel="stylesheet">
</head>
<body>
<main>
    @yield('header')
    @yield('main')
</main>
<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4 class="title">عضویت در خبرنامه</h4>
                    <form class="newsletters">
                        <div class="form-row align-items-center">
                            <div class="col-sm-7 col-md-8">
                                <input class="form-control" type="text" placeholder="آدرس ایمیل خود را وارد نمایید">
                            </div>
                            <div class="col-sm-5 col-md-4 no-p">
                                <button class="btn" type="submit">ثبت نام در خبرنامه</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-6 col-md-6"><img class="logo-footer" src="content/img/logo.png" alt=""></div>
                        <div class="col-sm-6 col-md-6">
                            <div class="slider-footer">
                                <div class="item"><img src="{{asset('users/img/enamad.png')}}" alt=""></div>
                                <div class="item"><img src="{{asset('users/img/enamad.png')}}" alt=""></div>
                                <div class="item"><img src="{{asset('users/img/enamad.png')}}" alt=""></div>
                                <div class="item"><img src="{{asset('users/img/enamad.png')}}" alt=""></div>
                                <div class="item"><img src="{{asset('users/img/enamad.png')}}" alt=""></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="footer-social">
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon026.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon026.png')}}" alt=""></a></li>
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon027.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon027.png')}}" alt=""></a></li>
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon028.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon028.png')}}" alt=""></a></li>
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon029.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon029.png')}}" alt=""></a></li>
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon030.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon030.png')}}" alt=""></a></li>
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon031.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon031.png')}}" alt=""></a></li>
                                <li><a href="" title=""><img src="{{asset('users/img/icon/icon032.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon032.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h4 class="title">لینک های مفید</h4>
                    <ul class="list-footer">
                        <li><a href="" title="صفحه اصلی">صفحه اصلی</a></li>
                        <li><a href="" title="اجاره ویلا">اجاره ویلا</a></li>
                        <li><a href="" title="اجاره سوئیت ">اجاره سوئیت</a></li>
                        <li><a href="" title="جاذبه های گردشگرری">جاذبه های گردشگرری</a></li>
                        <li><a href="" title="درباره ما">درباره ما</a></li>
                        <li><a href="" title="تماس با ما">تماس با ما</a></li>
                        <li><a href="" title="راهنمای سایت">راهنمای سایت</a></li>
                        <li><a href="" title="راهنمای سایت">راهنمای سایت</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h4 class="title">میهمانان</h4>
                    <ul class="list-footer">
                        <li><a href="" title="راهنمای سایت">راهنمای سایت</a></li>
                        <li><a href="" title="چگونه رزور کنم ؟">چگونه رزور کنم ؟</a></li>
                        <li><a href="" title="مقررات لغو رزرو">مقررات لغو رزرو</a></li>
                        <li><a href="" title="ضمانت برگشت وجه">ضمانت برگشت وجه</a></li>
                    </ul>
                    <h4 class="title">میزبانان</h4>
                    <ul class="list-footer">
                        <li><a href="" title="چگونه میزبان شوم ؟">چگونه میزبان شوم ؟</a></li>
                        <li><a href="" title="مقررات و قوانین "> مقررات و قوانین</a></li>
                        <li><a href="" title="استاندارد های میزبانی">استاندارد های میزبانی</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h4 class="title">شهر های پرطرفدار</h4>
                    <ul class="list-footer">
                        <li><a href="" title="مازندران - ساری">مازندران - ساری</a></li>
                        <li><a href="" title="مازندران - بایلسر">مازندران - بایلسر</a></li>
                        <li><a href="" title="مازندران - خزر شهر">مازندران - خزر شهر</a></li>
                        <li><a href="" title="گیلان - رشت">گیلان - رشت</a></li>
                        <li><a href="" title="گلستان - گرگان">گلستان - گرگان</a></li>
                        <li><a href="" title="فارس - شیراز">فارس - شیراز</a></li>
                        <li><a href="" title="تبریز - سراب">تبریز - سراب</a></li>
                        <li><a href="" title="مازندران - فریدون کنار">مازندران - فریدون کنار</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h4 class="title">جاذبه های گردشگری برتر</h4>
                    <ul class="list-footer">
                        <li><a href="" title="عمارت چهل ستون">عمارت چهل ستون</a></li>
                        <li><a href="" title="مسجد شیخ لطف الله">مسجد شیخ لطف الله</a></li>
                        <li><a href="" title="برج آجری قابوس">برج آجری قابوس</a></li>
                        <li><a href="" title="عمارت چهل ستون">عمارت چهل ستون</a></li>
                        <li><a href="" title="مسجد شیخ لطف الله">مسجد شیخ لطف الله</a></li>
                        <li><a href="" title="برج آجری قابوس">برج آجری قابوس</a></li>
                        <li><a href="" title="عمارت چهل ستون">عمارت چهل ستون</a></li>
                        <li><a href="" title="مسجد شیخ لطف الله">مسجد شیخ لطف الله</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end footer-->
<!--start scripts-->
<script src="{{asset('users/js/jquery.min.js')}}"></script>
<script src="{{asset('users/js/popover.js')}}"></script>
<script src="{{asset('users/js/bootstrap.min.js')}}"></script>
<script src="{{asset('users/js/tether.min.js')}}"></script>
<script src="{{asset('users/plugin/rating/jquery.star-rating-svg.js')}}"></script>
<script src="{{asset('users/plugin/slick/slick.js')}}"></script>
<script src="{{asset('users/plugin/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('users/plugin/datepicker/bootstrap-datepicker.fa.min.js')}}"></script>
<script src="{{asset('users/plugin/sticky/theia-sticky-sidebar.js')}}"></script>
<script src="{{asset('users/plugin/smint/jquery.smint.js')}}"></script>
@yield('jsmap')
<script type="text/javascript" src="{{asset('users/js/customHome.js')}}"></script>
<!--end scripts-->
</body>
</html>
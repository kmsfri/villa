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
    <script src="{{asset('users/js/jquery.min.js')}}"></script>
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
                    <form class="newsletters nlform">
                        <input type="hidden" value="{{csrf_token()}}" class="mailtoken">
                        <div class="form-row align-items-center">
                            <div class="col-sm-7 col-md-8">
                                <input class="form-control nl" type="email" name="email" placeholder="آدرس ایمیل خود را وارد نمایید">
                            </div>
                            <div class="col-sm-5 col-md-4 no-p">
                                <button class="btn" type="button" onclick="register_mail();">ثبت نام در خبرنامه</button>
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
                                @foreach($socialMedia as $sM)
                                    <li><a href="{{$sM->s_link}}" title=""><img src="{{asset($sM->img_dir)}}" alt="{{$sM->s_title}}"><img class="img" src="{{asset($sM->img_dir)}}" alt="{{$sM->s_title}}"></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach($footerLinks as $fT)
                <div class="col-6 col-lg-2">
                    <h4 class="title">{{$fT->link_title}}</h4>
                    <ul class="list-footer">
                        @foreach($fT->SubLinkEnabledOrdered()->get() as $fTSL)
                        <li><a href="{{$fTSL->link_url}}" title="{{$fTSL->link_title}}">{{$fTSL->link_title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</footer>
<!--end footer-->
<!--start scripts-->

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
<script type="text/javascript">
    function register_mail() {
        $.post("{{route('newsletter_register')}}", { _token: $('.mailtoken').val(), email: $('.nl').val() } , function(data){
            if(data == "ok"){
                $( ".nlform" ).replaceWith( "<p style='color:red'>با موفقیت ثبت شد</p>" );
            }
            else if(data == "exist"){
                alert('این ایمیل قبلا ثبت شده است');
            }
            else{
                alert( "فرمت ایمیل صحیح نمی باشد" );
            }
        })
            .fail(function() {
                alert( "دوباره تلاش کنید" );
            })

    }
</script>
<script type="text/javascript" src="{{asset('users/js/customHome.js')}}"></script>
<!--end scripts-->
</body>
</html>
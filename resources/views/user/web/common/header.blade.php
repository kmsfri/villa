<!--start header-->
<header class="header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg nav-vila"><a class="navbar-brand" href="#"><img class="logo" src="{{asset('users/img/logo.png')}}"></a>
            <ul class="navbar-nav ul-nav">
                @foreach($menuLinks as $mL)
                    <li><a href="{{$mL->link_url}}" title="{{$mL->link_title}}">{{$mL->link_title}}</a></li>
                @endforeach
            </ul>
            <ul class="login">
                <li><a class="login" href="{{Route('showlogin')}}" title="ورود به سایت">ورود به سایت</a></li>
                <li><a class="record" href="{{Route('addVillaForm')}}" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
            </ul>
        </nav>
    </div>
</header>
<!--end header-->
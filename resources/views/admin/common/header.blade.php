<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a href="{{Route('dashboard')}}">
            <img style="padding:5px 5px 0 0" class="img img-responsive" src="{{asset('logo.png')}}" alt="ویلایار"/>
        </a>
    </div>
    <ul class="nav navbar-top-links navbar-left">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu leftzero dropdown-user">
                <li><a href="{{url(Route('admin-user-list'))}}"><i class="fa fa-user fa-fw"></i> تنظیمات حساب کاربری</a></li>
                <li class="divider"></li>
                <li><a href="{{url(Route('do-admin-logout'))}}"><i class="fa fa-sign-out fa-fw"></i> خروج</a></li>
            </ul>
        </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="" href="{{url(Route('dashboard'))}}"><i class="fa fa-dashboard fa-fw"></i> داشبورد</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> کاربران<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{Route('admin-user-list')}}">کاربران بخش مدیریت</a>
                        </li>
                        <li>
                            <a href="{{Route('renter-user-list')}}">کاربران وبسایت</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> دسته بندیها<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{Route('cities-list')}}">استان-شهر-منطقه</a>
                        </li>
                        <li>
                            <a href="{{Route('categories3-list')}}">مطالب گردشگری</a>
                        </li>
                        <li>
                            <a href="{{Route('categories1-list')}}">ویلاها(نوع اول)</a>
                        </li>
                        <li>
                            <a href="{{Route('adminVillaTypeList')}}">نوع ویلا</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i>محتوا<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{Route('adminShowContentList')}}">مطالب گردشگری</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="" href="{{url(Route('propertiesList'))}}"><i class="fa fa-book fa-fw"></i>خصوصیات و مقادیر</a>
                </li>

                <li>
                    <a class="" href="{{url(Route('adminShowVillaList'))}}"><i class="fa fa-book fa-fw"></i>ویلاها</a>
                </li>

                <li>
                    <a class="" href="{{url(Route('adminTariffList'))}}"><i class="fa fa-book fa-fw"></i>تعرفه ها</a>
                </li>

                <li>
                    <a class="" href="{{url(Route('adminTicketList'))}}"><i class="fa fa-book fa-fw"></i>تیکت ها</a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i>ارتباطات<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{Route('adminReportList')}}">گزارش تخلف ویلاها</a>
                        </li>
                        <li>
                            <a href="{{Route('adminContentReportList')}}">گزارش تخلف مطالب</a>
                        </li>
                        <li>
                            <a href="{{Route('adminVillaCommentList')}}">نظرات ویلاها</a>
                        </li>
                        <li>
                            <a href="{{Route('adminContentCommentList')}}">نظرات مطالب</a>
                        </li>
                        <li>
                            <a href="{{Route('adminWebsiteCommentList')}}">نظرات وبسایت</a>
                        </li>


                    </ul>
                </li>


                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i>تنظیمات وبسایت<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{Route('footerLink_list')}}">لینک های فوتر</a>
                        </li>
                        <li>
                            <a href="{{Route('menuLink_list')}}">لینک های منوی اصلی</a>
                        </li>
                        <li>
                            <a href="{{Route('adminSocials')}}">شبکه های اجتماعی</a>
                        </li>

                    </ul>
                </li>








            </ul>
        </div>
    </div>
</nav>
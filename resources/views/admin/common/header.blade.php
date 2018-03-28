<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">ویلایار</a>
    </div>
    <ul class="nav navbar-top-links navbar-left">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu leftzero contactscroll dropdown-messages">
                <li>
                    <a href="#">
                        <div>
                            <strong>علی محی</strong>
                            <span class="pull-left text-muted">
                                        <em>1396/1/1 14:50</em>
                                    </span>
                        </div>
                        <div>متن پیام 50 کاراکتر آخر متن هم سه نقطه... پیام هایی که خوانده نشده اند ... با کلیک بر روی متن به صفحه نمایش کامل پیام هدایت بشه</div>
                    </a>
                </li>
                <li class="divider"></li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>نمایش تمام پیام ها</strong>
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu leftzero contactscroll dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-money fa-fw"></i> خرید جدید
                            <span class="pull-left text-muted small">1396/1/1 14:50</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>نمایش تمام تراکنش ها</strong>
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu leftzero dropdown-user">
                <li><a href="{{url(Route('admin-user-list'))}}"><i class="fa fa-user fa-fw"></i> تنظیمات حساب کاربری</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{url(Route('do-admin-logout'))}}"><i class="fa fa-sign-out fa-fw"></i> خروج</a>
                </li>
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
                            <a href="{{Route('categories2-list')}}">ویلاها(نوع دوم)</a>
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

            </ul>
        </div>
    </div>
</nav>
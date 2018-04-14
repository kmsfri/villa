<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a href="<?php echo e(Route('dashboard')); ?>">
            <img style="padding:5px 5px 0 0" class="img img-responsive" src="<?php echo e(asset('logo.png')); ?>" alt="ویلایار"/>
        </a>
    </div>
    <ul class="nav navbar-top-links navbar-left">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu leftzero dropdown-user">
                <li><a href="<?php echo e(url(Route('admin-user-list'))); ?>"><i class="fa fa-user fa-fw"></i> تنظیمات حساب کاربری</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo e(url(Route('do-admin-logout'))); ?>"><i class="fa fa-sign-out fa-fw"></i> خروج</a></li>
            </ul>
        </li>
    </ul>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="" href="<?php echo e(url(Route('dashboard'))); ?>"><i class="fa fa-dashboard fa-fw"></i> داشبورد</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> کاربران<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo e(Route('admin-user-list')); ?>">کاربران بخش مدیریت</a>
                        </li>
                        <li>
                            <a href="<?php echo e(Route('renter-user-list')); ?>">کاربران وبسایت</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> دسته بندیها<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo e(Route('cities-list')); ?>">استان-شهر-منطقه</a>
                        </li>
                        <li>
                            <a href="<?php echo e(Route('categories3-list')); ?>">مطالب گردشگری</a>
                        </li>
                        <li>
                            <a href="<?php echo e(Route('categories1-list')); ?>">ویلاها(نوع اول)</a>
                        </li>
                        <li>
                            <a href="<?php echo e(Route('categories2-list')); ?>">ویلاها(نوع دوم)</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i>محتوا<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo e(Route('adminShowContentList')); ?>">مطالب گردشگری</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="" href="<?php echo e(url(Route('propertiesList'))); ?>"><i class="fa fa-book fa-fw"></i>خصوصیات و مقادیر</a>
                </li>

                <li>
                    <a class="" href="<?php echo e(url(Route('adminShowVillaList'))); ?>"><i class="fa fa-book fa-fw"></i>ویلاها</a>
                </li>

                <li>
                    <a class="" href="<?php echo e(url(Route('adminTariffList'))); ?>"><i class="fa fa-book fa-fw"></i>تعرفه ها</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
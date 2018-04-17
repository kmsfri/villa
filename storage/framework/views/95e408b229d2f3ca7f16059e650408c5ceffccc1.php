<div class="col-md-5 col-lg-4 sticky-vila">
    <aside class="theiaStickySidebar">
        <div class="box-price d-none d-md-inline-block">
            <div class="header">
                <p class="title">نرخ اجاره روزانه از<span>(هر شب)</span></p><span><?php echo e(number_format($villa->rent_daily_price_from)); ?> تومان</span>
            </div>
            <div class="data">
                <div class="box-property"><img class="img-author" src="<?php echo e(asset('users/img/img0012452.jpg')); ?>" alt="">
                    <p class="title-author"><?php echo e($user->fullname); ?></p>
                    <p><img src="<?php echo e(asset('users/img/icon/icon089.png')); ?>" alt=""><?php echo e($user->mobile_number); ?></p>
                    <p><img src="<?php echo e(asset('users/img/icon/icon090.png')); ?>" alt="">کدملک :<span><?php echo e($villa->id); ?></span></p>
                    <div class="clearfix"></div>
                </div>
                <p>هنگام تماس تلفنی، لطفاً به کد ملک <?php echo e($villa->id); ?> در ویلایار اشاره کنید تا سریع‌تر راهنمایی شوید. قبل از تماس، راهنمای معامله امن و قوانین را بخوانید</p>
                <ul class="ul">
                    <li><a href="tel://<?php echo e($user->mobile_number); ?>" title="">تماس با مالک<img src="<?php echo e(asset('users/img/icon/icon091.png')); ?>" alt=""></a></li>
                    <li><a href="tg://resolve?domain=<?php echo e($user->telegram_link); ?>" title="">ارسال پیام در تلگرام<img src="<?php echo e(asset('users/img/icon/icon092.png')); ?>" alt=""></a></li>
                    <li><a href="sms://<?php echo e($user->mobile_number); ?>" title="">ارسال پیامک به مالک<img src="<?php echo e(asset('users/img/icon/icon093.png')); ?>" alt=""></a></li>
                </ul>
            </div>
        </div>
        <div class="box-price d-none d-md-inline-block">
            <form class="search" method="post" action="<?php echo e(route('reserve_request',$villa->id)); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group width">
                    <ul class="ul-date">
                        <li>
                            <p>از تاریخ</p>
                        </li>
                        <li>
                            <p>تا تاریخ</p>
                        </li>
                    </ul>
                    <div class="width">
                        <input class="form-control datepicker" name="date_in" type="text" value="<?php echo e(old('date_in')); ?>" placeholder="تاریخ ورود" required>
                        <input class="form-control datepicker" name="date_out" type="text" value="<?php echo e(old('date_out')); ?>" placeholder="تاریخ خروج" required>
                    </div>
                </div>
                <div class="form-group guest arrow">
                    <label>تعداد میهمانان</label>
                    <select class="custom-select" required="" name="pc">
                        <option value="">انتخاب تعداد نفرات</option>
                        <?php for($i=1;$i <= $villa->max_capacity;$i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div><span>   کودکان بیش از 2 سال ((یک نفر )) محسوب می شوند</span>
                <div class="form-group name">
                    <label>نام و نام خانوادگی</label>
                    <input class="form-control" type="text" name="fullname" value="<?php echo e(old('fullname')); ?>" placeholder="نام و نام خانوادگی" required>
                </div>
                <div class="form-group contact">
                    <label>شماره تماس</label>
                    <input class="form-control" type="tel" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="شماره تماس- مثال(0912000000)" required>
                </div>
                <button class="btn btn-form" type="submit" placeholder="ارسال درخواست رزرو ویلا">ارسال درخواست رزرو ویلا</button>
            </form>
        </div>
        <div class="box-aside text-center">
            <h3 class="title-center">اشتراک مطلب برای دوستان</h3>
            <ul class="ul-social">
                <li><a href="https://plus.google.com/share?url=<?php echo e(url()->current()); ?>" title=""><img src="<?php echo e(asset('users/img/icon/icon033.png')); ?>" alt=""><img class="img" src="<?php echo e(asset('users/img/icon/icon033.png')); ?>" alt=""></a></li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>" title=""><img src="<?php echo e(asset('users/img/icon/icon034.png')); ?>" alt=""><img class="img" src="<?php echo e(asset('users/img/icon/icon034.png')); ?>" alt=""></a></li>
                <li><a href="tg://msg_url?url=<?php echo e(url()->current()); ?>" title=""><img src="<?php echo e(asset('users/img/icon/icon035.png')); ?>" alt=""><img class="img" src="<?php echo e(asset('users/img/icon/icon035.png')); ?>" alt=""></a></li>
                <li><a href="" title=""><img src="<?php echo e(asset('users/img/icon/icon036.png')); ?>" alt=""><img class="img" src="<?php echo e(asset('users/img/icon/icon036.png')); ?>" alt=""></a></li>
            </ul><a class="link-violation" href="" title="گزارش تخلف این مطلب"><img src="<?php echo e(asset('users/img/icon/icon037.png')); ?>" alt="">گزارش تخلف این مطلب</a>
        </div>
        <ul class="ul-aside">
            <li><a href="" title=""><img src="<?php echo e(asset('users/img/icon/icon038.png')); ?>" alt=""><span>کانال تلگرام ویلایار</span></a></li>
            <li><a href="" title=""><img src="<?php echo e(asset('users/img/icon/icon039.png')); ?>" alt=""><span>اینستاگرام ویلایار</span></a></li>
        </ul>
    </aside>
</div>
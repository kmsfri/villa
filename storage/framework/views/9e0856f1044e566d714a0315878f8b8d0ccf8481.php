<a class="link-rent" href="" title=""><img src="<?php echo e(asset('users/img/icon/icon0106.png')); ?>" alt=""></a>
<div class="modal-filter"><a class="close" href="" title="">×</a><span class="header-upper-title">0 آگهی</span>
    <form class="search">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group arrow">
                    <label>استان</label>
                    <select class="custom-select" id="state2" required="">
                        <option value="0">همه استان ها</option>
                        <?php if(count($states)): ?>
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state->id); ?>"><?php echo e($state->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group arrow">
                    <label>شهر</label>
                    <select class="custom-select" id="city2" required="">
                        <option value="0">همه شهر ها</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group area arrow">
                    <label>منطقه / محله</label>
                    <select class="custom-select" id="region2" required="">
                        <option value="0">منطقه مورد نظر</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group code">
                    <label>کد ملک</label>
                    <input class="form-control" type="text" placeholder="کد ملک را وارد نمایید">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group type arrow">
                    <label>نوع ملک / ویلا</label>
                    <select class="custom-select" required="">
                        <option value="">جنگلی</option>
                        <option value="1">جنگلی</option>
                        <option value="2">جنگلی</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group capacity arrow">
                    <label>ظرفیت نفرات</label>
                    <select class="custom-select" required="">
                        <option value="">تعداد نفر</option>
                        <option value="1">تعداد نفر</option>
                        <option value="2">تعداد نفر</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group number arrow">
                    <label>تعداد اتاق ها</label>
                    <select class="custom-select" required="">
                        <option value="">تعداد اتاق ها</option>
                        <option value="1">تعداد اتاق ها</option>
                        <option value="2">تعداد اتاق ها</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group rent arrow">
                    <label>اجاره بها هر شب تا</label>
                    <select class="custom-select" required="">
                        <option value="">انتخاب کنید</option>
                        <option value="1">اول هفته</option>
                        <option value="2">وسط هفته</option>
                        <option value="2">آخر هفته</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
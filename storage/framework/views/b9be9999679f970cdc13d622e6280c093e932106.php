<?php if(session('cities')): ?>
    <?php
        $cities=session('cities');
    ?>
<?php endif; ?>
<?php if(session('districts')): ?>
    <?php
        $districts=session('districts');
    ?>
<?php endif; ?>
<section class="search">
    <div class="container">
        <!--h1.title با ویلایار خیلی راحت ویلاتو پیدا کن !-->
        <div class="box-search">
            <form class="search d-flex d-md-none" action="<?php echo e(Route('search')); ?>" method="GET">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group arrow">
                            <select class="custom-select" id="state3" name="state" autocomplete="off">
                                <option <?php echo e((!old('state', isset($search->state) ? $search->state : '')? 'selected' : '')); ?> value="" >همه استانها</option>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('state', isset($search->state) ? $search->state : '')==$pr->id): ?> selected <?php endif; ?> value="<?php echo e($pr->id); ?>" ><?php echo e($pr->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group arrow">
                            <select class="custom-select" id="city3" name="city" autocomplete="off">
                                <option <?php echo e((!old('city', isset($search->city) ? \App\Models\City::find($search->city)->province()->first()->id : '')? 'selected' : '')); ?> value="" disabled>شهر را انتخاب کنید</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('city', isset($search->city) ? $search->city : '')==$city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>" ><?php echo e($city->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group code">
                            <input class="form-control" name="villa_code" type="text" placeholder="کد ملک" value="<?php echo e(old('villa_code', isset($search->villa_code) ? $search->villa_code : '')); ?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group arrow">
                            <select class="custom-select">
                                <option value="">بروز شده ها</option>
                                <option value="1">تهران</option>
                                <option value="2">اصفهان</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <form id="searchFrm1" class="search d-md-flex d-none" action="<?php echo e(Route('search')); ?>" method="GET">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group arrow">
                            <label>استان</label>
                            <select class="custom-select" id="state4" name="state" autocomplete="off">
                                <option <?php echo e((!old('state', isset($search->state) ? $search->state : '')? 'selected' : '')); ?> value="" >همه استانها</option>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('state', isset($search->state) ? $search->state : '')==$pr->id): ?> selected <?php endif; ?> value="<?php echo e($pr->id); ?>" ><?php echo e($pr->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group arrow">
                            <label>شهر</label>
                            <select class="custom-select" id="city4" name="city" autocomplete="off">
                                <option <?php echo e((!old('city', isset($search->city) ? \App\Models\City::find($search->city)->province()->first()->id : '')? 'selected' : '')); ?> value="" disabled>همه شهرها</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('city', isset($search->city) ? $search->city : '')==$city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>" ><?php echo e($city->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group area arrow">
                            <label>منطقه / محله</label>
                            <select class="custom-select" id="region4" name="district" autocomplete="off">
                                <option <?php echo e((!old('district', isset($search->district) ? $search->district : '')? 'selected' : '')); ?> value="" disabled>همه منطقه ها</option>
                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('district', isset($search->district) ? $search->district : '')==$dst->id): ?> selected <?php endif; ?> value="<?php echo e($dst->id); ?>" ><?php echo e($dst->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group code">
                            <label>کد ملک</label>
                            <input class="form-control" name="villa_code" type="text" placeholder="کد ملک را وارد نمایید" value="<?php echo e(old('villa_code', isset($search->villa_code) ? $search->villa_code : '')); ?>">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group type arrow">
                            <label>نوع ملک / ویلا</label>
                            <select class="custom-select" name="villaTypes">
                                <option <?php echo e((!old('villaTypes', isset($search->villaTypes) ? $search->villaTypes : '')? 'selected' : '')); ?> value="" >انتخاب کنید</option>
                                <?php $__currentLoopData = $villaTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $VT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('villaTypes', isset($search->villaTypes) ? $search->villaTypes : '')==$VT->id): ?> selected <?php endif; ?> value="<?php echo e($VT->id); ?>" ><?php echo e($VT->villa_type_title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group capacity arrow">
                            <label>ظرفیت نفرات</label>
                            <select class="custom-select" name="standard_capacity" autocomplete="off">
                                <option <?php echo e((!old('standard_capacity', isset($search->standard_capacity) ? $search->standard_capacity : '')? 'selected' : '')); ?> value="" >انتخاب کنید</option>
                                <?php for($i=1;$i<=20;$i++): ?>
                                    <option <?php echo e((old('standard_capacity', isset($search->standard_capacity) ? $search->standard_capacity : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?> نفر</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group number arrow">
                            <label>تعداد اتاق ها</label>
                            <select class="custom-select" name="bedroom_count" autocomplete="off">
                                <option <?php echo e((!old('bedroom_count', isset($search->bedroom_count) ? $search->bedroom_count : '')? 'selected' : '')); ?> value="" >انتخاب کنید</option>
                                <?php for($i=1;$i<=10;$i++): ?>
                                    <option <?php echo e((old('bedroom_count', isset($search->bedroom_count) ? $search->bedroom_count : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?> </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group rent arrow">
                            <label>زمان اجاره</label>
                            <select class="custom-select" name="rent_day">
                                <option <?php echo e((old('rent_day', isset($search->rent_day) ? $search->rent_day : '')==Null)?'selected':''); ?> value="">تمام روزها</option>
                                <option <?php echo e((old('rent_day', isset($search->rent_day) ? $search->rent_day : '')=='midweek')?'selected':''); ?> value="midweek">وسط هفته</option>
                                <option <?php echo e((old('rent_day', isset($search->rent_day) ? $search->rent_day : '')=='lastweek')?'selected':''); ?> value="lastweek">آخر هفته</option>
                                <option <?php echo e((old('rent_day', isset($search->rent_day) ? $search->rent_day : '')=='peaktime')?'selected':''); ?> value="peaktime">ایام پیک</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group rent">
                            <label>اجاره بها هر شب تا مبلغ</label>
                            <input class="form-control" name="price" type="text" placeholder="100.000 تومان" value="<?php echo e(old('price_to_search', isset($search->price_to_search) ? $search->price_to_search.' تومان' : '')); ?>" autocomplete="off">
                            <input type="hidden"  name="price_to_search" value="<?php echo e(old('price_to_search', isset($search->price_to_search) ? $search->price_to_search : '')); ?>" autocomplete="off">
                            <button class="button left" type="button" data-enevtsum="sum">+</button>
                            <button class="button" type="button" data-enevtsum="sub">-</button>

                            <script>
                                jQuery(document).ready(function(){

                                    (function(a){a.extend({persianNumbers:function(b){var g={0:"۰",1:"۱",2:"۲",3:"۳",4:"۴",5:"۵",6:"۶",7:"۷",8:"۸",9:"۹"};var d=(b+"").split("");var f=d.length;var c;for(var e=0;e<=f;e++){c=d[e];if(g[c]){d[e]=g[c]}}return d.join("")}})})(jQuery);
                                    jQuery(document).on('click', '[data-enevtsum]', function(){
                                        var typesum = jQuery(this).data('enevtsum');
                                        var thisvalue = jQuery("input[name=price]").val();
                                        var repl = parseInt(jQuery("input[name=price_to_search]").val());

                                        let mo = 100000;
                                        if(typesum ==="sub") {
                                            var newprice = parseInt(repl) - mo;
                                        } else {
                                            var newprice = parseInt(repl) + mo;
                                        }

                                        jQuery("input[name=price_to_search]").val(newprice);
                                        var parts = newprice.toString().split(".");
                                        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        var new_price =  jQuery.persianNumbers(parts.join(".")) + " تومان";

                                        jQuery("input[name=price]").val(new_price);
                                    });




                                });
                            </script>
                        </div>
                    </div>
                </div>
            </form>
            <div class="footer d-md-block d-none"><a class="link-filter" href="" data-toggle="modal" data-target="#filterModal" title="فیلتر ها">فیلتر ها
                    <!--a.link-filter(href='', title='بروز شده ترین ویلا ها') بروز شده ترین ویلا ها--></a>
                <div class="form-group arrow">
                    <select class="custom-select">
                        <option value="">بروز شده ترین ویلا ها</option>
                        <option value="1">تهران</option>
                        <option value="2">تهران</option>
                        <option value="3">تهران</option>
                    </select>
                </div><button type="submit" form="searchFrm1" class="btn-search">جستجو کن</button>
                <!--.clearfix-->
            </div>
        </div>
    </div>
</section>
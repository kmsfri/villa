<?php if(count($villas)): ?>
    <section class="vila">
        <div class="container">
            <div class="row justify-content-sm-center">

                <?php $__currentLoopData = $villas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $villa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-md-6 col-lg-3">

                        <article class="vila">
                            <figure><img src="<?php echo e(asset($villa->VillaImages()->orderBy('image_order','ASC')->first()->image_dir)); ?>" alt="<?php echo e($villa->villa_title); ?>"/><a class="estate" href="" title="<?php echo e($villa->villa_title); ?>">مشاهده ملک</a><a class="heart" href=""><i class="fa fa-heart-o"></i></a></figure>
                            <div class="data">
                                <h3 class="title"><a href="" title="<?php echo e($villa->villa_title); ?>"><?php echo e($villa->villa_title); ?></a></h3><span class="price"><?php echo e(number_format($villa->rent_daily_price_from)); ?> تومان</span>
                                <?php $city = $villa->Cities()->first(); ?>
                                <p class="place customheight"><?php echo e(\App\Models\City::find($city->parent_id)->city_name); ?> - <?php echo e($city->city_name); ?></p>
                                <div class="my-rating-8"></div><span class="number"><span><?php echo e($villa->Comments()->where('comment_status','=',1)->count()); ?></span></span>
                            </div>
                            <ul>
                                <li><img src="<?php echo e(asset('users/img/icon/icon088.png')); ?>" alt=""><span><?php echo e($villa->bed_count); ?> تخت خواب</span></li>
                                <li><img src="<?php echo e(asset('users/img/icon/icon087.png')); ?>" alt=""><span>تا <?php echo e($villa->max_capacity); ?> مهمان</span></li>
                                <li><img src="<?php echo e(asset('users/img/icon/icon086.png')); ?>" alt=""><span><?php echo e($villa->bedroom_count); ?> اتاق خواب</span></li>
                                <li><img src="<?php echo e(asset('users/img/icon/icon085.png')); ?>" alt=""><span><?php echo e($villa->foundation_area); ?> متر زیربنا</span></li>
                            </ul>
                        </article>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
            <div class="pagination" style="display:table;margin:0 auto;padding-top: 20px;padding-bottom: 20px;"><?php echo str_replace('/?', '?', $villas->render()); ?></div>
            <div class="clearfix"></div>
        </div>
    </section>
<?php endif; ?>
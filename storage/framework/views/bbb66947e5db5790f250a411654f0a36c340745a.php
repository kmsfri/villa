<?php if(count($contents)): ?>
    <section class="tourism">
        <div class="container">
            <div class="box-title">
                <h2 class="title"><img src="<?php echo e(asset('users/img/icon/icon010.png')); ?>" alt="">جاذبه های گردشگری و توریستی</h2><a class="more" href="" title="مشاهده بیشتر">مشاهده بیشتر</a>
            </div>

            <div class="slider-tourism">
                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <article class="tourism">
                            <?php if($content->ContentImages()->first()!=Null): ?>
                                <img src="<?php echo e(asset('images/users/user-uploads/user-contents').'/'.$content->ContentImages()->orderBy('image_order','ASC')->first()->image_dir); ?>" alt="<?php echo e($content->content_title); ?>"/>
                            <?php else: ?>
                                <img src="<?php echo e(asset('images').'/404.jpg'); ?>" alt="<?php echo e($content->content_title); ?>"/>
                            <?php endif; ?>
                            <?php $city = $content->Cities()->first(); ?>
                            <p class="place"><?php echo e(\App\Models\City::find($city->parent_id)->city_name); ?> - <?php echo e($city->city_name); ?></p>

                            <div class="link"><a href="" title="<?php echo e($content->content_title); ?>"><?php echo e($content->content_title); ?></a></div>
                        </article>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php else: ?>
    <p style="text-align: center;margin-top: 200px;margin-bottom: 200px">مطلبی یافت نشد</p>
<?php endif; ?>
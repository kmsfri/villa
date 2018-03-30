<div class="col-md-5 col-lg-4 sticky-vila">
    <aside class="theiaStickySidebar">
        <div class="box-aside">
            <h2 class="title-aside">پربازدیدترین مطالب</h2>
            <?php if(count($mostvisitcontents)): ?>
                <?php $__currentLoopData = $mostvisitcontents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mostvisitcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="article-aside">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <figure>
                                    <?php if($mostvisitcontent->ContentImages()->first()!=Null): ?>
                                        <img src="<?php echo e(asset('images/users/user-uploads/user-contents').'/'.$mostvisitcontent->ContentImages()->first()->image_dir); ?>" alt="<?php echo e($mostvisitcontent->content_title); ?>"/>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images').'/404.jpg'); ?>" alt="<?php echo e($mostvisitcontent->content_title); ?>"/>
                                    <?php endif; ?>
                                </figure>
                            </div>
                            <div class="col-8 col-md-8 no-p">
                                <div class="data">
                                    <h3><a class="title" href="" title="<?php echo e($mostvisitcontent->content_title); ?>"><?php echo e($mostvisitcontent->content_title); ?></a></h3>
                                    <p>
                                        <?php if($mostvisitcontent->authorRenterUser()->first()!=Null): ?>
                                        <img src="<?php echo e(asset('images/users/user-uploads/user-pics').'/'.$mostvisitcontent->authorRenterUser()->first()->avatar_dir); ?>" alt="<?php echo e($mostvisitcontent->authorRenterUser()->first()->fullname); ?>"/><?php echo e($mostvisitcontent->authorRenterUser()->first()->fullname); ?>

                                        <?php elseif($mostvisitcontent->authorAdminUser()->first()!=Null): ?>
                                        <span>مدیر سایت</span>
                                        <?php else: ?>
                                        <span>بدون تصویر</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
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
</div>
</div>
</section>
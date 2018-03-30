<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('user.web.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>
    <!--start section blog-->
    <section class="blog">
        <div class="container">
            <div class="row">
                <?php if(count($pinedcontents)): ?>
                    <?php $__currentLoopData = $pinedcontents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinedcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6 col-lg-4"><a href="<?php echo e(route('showArticle',$pinedcontent->content_slug)); ?>" title="<?php echo e($pinedcontent->content_title); ?>">
                                <article class="article-blog">
                                    <figure>
                                        <?php if($pinedcontent->ContentImages()->first()!=Null): ?>
                                        <img src="<?php echo e(asset('images/users/user-uploads/user-contents').'/'.$pinedcontent->ContentImages()->first()->image_dir); ?>" alt="<?php echo e($pinedcontent->content_title); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('images').'/404.jpg'); ?>" alt="<?php echo e($pinedcontent->content_title); ?>"/>
                                        <?php endif; ?>
                                    </figure>
                                    <h2 class="title"><?php echo e($pinedcontent->content_title); ?></h2>
                                </article></a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!--end section blog-->
    <!--start nav-->
    <nav class="navbar navbar-expand-lg nav-blog">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent1" aria-controls="navbarContent1" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>
            <div class="collapse navbar-collapse" id="navbarContent1">
                <ul class="navbar-nav nav-blog">
                    <?php if(count($states)): ?>
                    <li class="dropdown"><a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="همه استان ها">همه استان ها</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo e(Route('provinceArticles',$state->city_slug)); ?>" title="<?php echo e($state->city_name); ?>"><?php echo e($state->city_name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if(count($categories)): ?>

                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($cat->SubCategory3EnabledOrdered()->count()>0): ?>
                                            <li class="dropdown"><a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo e($cat->category_title); ?>"><?php echo e($cat->category_title); ?></a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php $__currentLoopData = $cat->SubCategory3EnabledOrdered()->where('show_in_blog',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($cat->id == $sub->parent_id): ?>
                                                        <a class="dropdown-item" href="<?php echo e(Route('categoryArticles',$sub->category_slug)); ?>" title="<?php echo e($sub->category_title); ?>"><?php echo e($sub->category_title); ?></a>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </li>
                                    <?php elseif($cat->parent_id == null): ?>
                                    <li><a href="<?php echo e(Route('categoryArticles',$cat->category_slug)); ?>" title="<?php echo e($cat->category_title); ?>"><?php echo e($cat->category_title); ?></a></li>
                                    <?php else: ?>
                                        <?php if($cat->SubCategory3EnabledOrdered()->count() == 0): ?>
                                            <?php if($cat->ParentCategory3->show_in_blog == 0): ?>
                                            <li><a href="<?php echo e(Route('categoryArticles',$cat->category_slug)); ?>" title="<?php echo e($cat->category_title); ?>"><?php echo e($cat->category_title); ?></a></li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--end nav-->
    <!--start section details-->
    <section class="details">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <?php if(count($contents)): ?>
                    <div class="row">
                            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-6 col-lg-4">
                                    <article class="blog">
                                        <figure><a href="<?php echo e(route('showArticle',$content->content_slug)); ?>" title="<?php echo e($content->content_title); ?>">
                                                <?php if($content->ContentImages()->first()!=Null): ?>
                                                <img src="<?php echo e(asset('images/users/user-uploads/user-contents').'/'.$content->ContentImages()->first()->image_dir); ?>" alt="<?php echo e($content->content_title); ?>"/>
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('images').'/404.jpg'); ?>" alt="<?php echo e($content->content_title); ?>"/>
                                                <?php endif; ?>

                                            </a></figure>
                                        <div class="data">
                                            <h3><a class="title" href="<?php echo e(route('showArticle',$content->content_slug)); ?>" title="<?php echo e($content->content_title); ?>"><?php echo e($content->content_title); ?></a></h3>
                                            <div class="data2">
                                                <p><?php echo e(str_limit($content->content_short_desc,190)); ?></p>
                                            </div>
                                            <p class="author">
                                                <?php if($content->authorRenterUser()->first()!=Null): ?>
                                                <img src="<?php echo e(asset('images/users/user-uploads/user-pics').'/'.$content->authorRenterUser()->first()->avatar_dir); ?>" alt="<?php echo e($content->authorRenterUser()->first()->fullname); ?>"/>
                                                <?php endif; ?>
                                                <?php if($content->authorRenterUser()->first()!=Null): ?>
                                                <?php echo e($content->authorRenterUser()->first()->fullname); ?></p>
                                                <?php elseif($content->authorAdminUser()->first()!=Null): ?>
                                                    مدیر سایت
                                                <?php else: ?>
                                                    ناشناس
                                                <?php endif; ?>
                                            <p class="day"><?php \Carbon\Carbon::setLocale('fa'); ?> <?php echo e($content->created_at->diffForHumans()); ?></p><a class="more" href="<?php echo e(route('showArticle',$content->content_slug)); ?>" title="ادامه مطلب">ادامه مطلب</a>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                        <div class="pagination" style="display:table;margin:0 auto;"><?php echo str_replace('/?', '?', $contents->render()); ?></div>
                    <?php endif; ?>

                </div>
<?php echo $__env->make('user.web.common.blogsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--end section details-->





<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
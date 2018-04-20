<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>ویلایار<?php echo e((!empty($meta) && $meta->title!=Null)?' - '.$meta->title:''); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(!empty($meta)): ?>
<?php $__currentLoopData = $meta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <meta name="<?php echo e($key); ?>" content="<?php echo e($m); ?>">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    <?php echo (isset($canonical_url))?'<link rel="canonical" href="'.$canonical_url.'">':''; ?>

<?php if(!empty($openGraph)): ?>
<?php $__currentLoopData = $openGraph; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$og): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <meta property="og:<?php echo e($key); ?>" content="<?php echo e($og); ?>">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
    <link href="<?php echo e(asset('users/bs4/scss/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/plugin/rating/star-rating-svg.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/plugin/slick/slick.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/plugin/slick/slick-theme.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/plugin/font-awesome/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/plugin/datepicker//bootstrap-datepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/css/normalize.cs')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('users/css/style.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('users/js/jquery.min.js')); ?>"></script>
</head>
<body>
<main>
    <?php echo $__env->yieldContent('header'); ?>
    <?php echo $__env->yieldContent('main'); ?>
</main>
<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4 class="title">عضویت در خبرنامه</h4>
                    <form class="newsletters nlform">
                        <input type="hidden" value="<?php echo e(csrf_token()); ?>" class="mailtoken">
                        <div class="form-row align-items-center">
                            <div class="col-sm-7 col-md-8">
                                <input class="form-control nl" type="email" name="email" placeholder="آدرس ایمیل خود را وارد نمایید">
                            </div>
                            <div class="col-sm-5 col-md-4 no-p">
                                <button class="btn" type="button" onclick="register_mail();">ثبت نام در خبرنامه</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-6 col-md-6"><img class="logo-footer" src="content/img/logo.png" alt=""></div>
                        <div class="col-sm-6 col-md-6">
                            <div class="slider-footer">
                                <div class="item"><img src="<?php echo e(asset('users/img/enamad.png')); ?>" alt=""></div>
                                <div class="item"><img src="<?php echo e(asset('users/img/enamad.png')); ?>" alt=""></div>
                                <div class="item"><img src="<?php echo e(asset('users/img/enamad.png')); ?>" alt=""></div>
                                <div class="item"><img src="<?php echo e(asset('users/img/enamad.png')); ?>" alt=""></div>
                                <div class="item"><img src="<?php echo e(asset('users/img/enamad.png')); ?>" alt=""></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="footer-social">
                                <?php $__currentLoopData = $socialMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sM): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($sM->s_link); ?>" title=""><img src="<?php echo e(asset($sM->img_dir)); ?>" alt="<?php echo e($sM->s_title); ?>"><img class="img" src="<?php echo e(asset($sM->img_dir)); ?>" alt="<?php echo e($sM->s_title); ?>"></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php $__currentLoopData = $footerLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-lg-2">
                    <h4 class="title"><?php echo e($fT->link_title); ?></h4>
                    <ul class="list-footer">
                        <?php $__currentLoopData = $fT->SubLinkEnabledOrdered()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fTSL): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e($fTSL->link_url); ?>" title="<?php echo e($fTSL->link_title); ?>"><?php echo e($fTSL->link_title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
</footer>
<!--end footer-->
<!--start scripts-->

<script src="<?php echo e(asset('users/js/popover.js')); ?>"></script>
<script src="<?php echo e(asset('users/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('users/js/tether.min.js')); ?>"></script>
<script src="<?php echo e(asset('users/plugin/rating/jquery.star-rating-svg.js')); ?>"></script>
<script src="<?php echo e(asset('users/plugin/slick/slick.js')); ?>"></script>
<script src="<?php echo e(asset('users/plugin/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('users/plugin/datepicker/bootstrap-datepicker.fa.min.js')); ?>"></script>
<script src="<?php echo e(asset('users/plugin/sticky/theia-sticky-sidebar.js')); ?>"></script>
<script src="<?php echo e(asset('users/plugin/smint/jquery.smint.js')); ?>"></script>
<?php echo $__env->yieldContent('jsmap'); ?>
<script type="text/javascript">
    function register_mail() {
        $.post("<?php echo e(route('newsletter_register')); ?>", { _token: $('.mailtoken').val(), email: $('.nl').val() } , function(data){
            if(data == "ok"){
                $( ".nlform" ).replaceWith( "<p style='color:red'>با موفقیت ثبت شد</p>" );
            }
            else if(data == "exist"){
                alert('این ایمیل قبلا ثبت شده است');
            }
            else{
                alert( "فرمت ایمیل صحیح نمی باشد" );
            }
        })
            .fail(function() {
                alert( "دوباره تلاش کنید" );
            })

    }
</script>
<script type="text/javascript" src="<?php echo e(asset('users/js/customHome.js')); ?>"></script>
<!--end scripts-->
</body>
</html>
<!--start header-->
<header class="header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg nav-vila"><a class="navbar-brand" href="#"><img class="logo" src="<?php echo e(asset('users/img/logo.png')); ?>"></a>
            <ul class="navbar-nav ul-nav">
                <?php $__currentLoopData = $menuLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mL): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e($mL->link_url); ?>" title="<?php echo e($mL->link_title); ?>"><?php echo e($mL->link_title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <ul class="login">
                <li><a class="login" href="<?php echo e(Route('showlogin')); ?>" title="ورود به سایت">ورود به سایت</a></li>
                <li><a class="record" href="<?php echo e(Route('addVillaForm')); ?>" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
            </ul>
        </nav>
    </div>
</header>
<!--end header-->
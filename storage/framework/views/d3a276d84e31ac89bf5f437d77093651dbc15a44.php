<div class="header-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                <ul class="ul-header">
                    <li><a class="record" href="" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<ul class="breadcrumb">
    <?php $__currentLoopData = $sectionPath; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="" title="<?php echo e($sp->title); ?>"><?php echo e($sp->title); ?></a></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if(isset($headingButton)): ?>
    <a class="btn btn-info pull-left" href="<?php echo e($headingButton->url); ?>" title="<?php echo e($headingButton->title); ?>"><?php echo e($headingButton->title); ?><i class="fa fa-file"></i></a>
    <?php endif; ?>
</ul>
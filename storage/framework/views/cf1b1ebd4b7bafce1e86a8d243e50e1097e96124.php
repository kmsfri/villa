<?php $__env->startSection('main'); ?>
<div class="box-panel">
    <div class="header">
        <h3>اخطار</h3>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group text-center">
                    <h4><?php echo e($err_msg); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
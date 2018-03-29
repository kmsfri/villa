<?php $__env->startSection('content_list'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="title1">
                <h3>اخطار</h3>
                <hr class="hr2">
            </div>
        </div>
    </div>
    <div class="admin-content-cont">
        <center><h4><?php echo e($err_msg); ?></h4></center>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
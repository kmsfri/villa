<?php $__env->startSection('main'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="post" action="<?php echo e($actionURL); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="edit_id" value="<?php if(isset($edit_id)): ?> <?php echo e($edit_id); ?> <?php endif; ?>">
                    <?php echo $__env->make('user.panel.common.alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->yieldContent('formBody'); ?>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">عملیات</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                            <button class="btn btn-primary pull-right" type="submit">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.panel.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
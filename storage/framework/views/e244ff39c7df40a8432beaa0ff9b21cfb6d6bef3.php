<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i><?php echo $title; ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($request_type=='edit'): ?>
                                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo e(url($post_edit_url)); ?>" autocomplete="off">
                                <input type="hidden" name="edit_id" value="<?php echo e(old('edit_id',isset($edit_id) ? $edit_id : '')); ?>">
                            <?php else: ?>
                                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo e(url($post_add_url)); ?>">
                            <?php endif; ?>
                            <?php echo e(csrf_field()); ?>

                                    <?php echo $__env->yieldContent('content_add_form'); ?>
                                    <div class="form-group">
                                        <div class="col-md-3 pull-left">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-sign-in"></i> ذخیره
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
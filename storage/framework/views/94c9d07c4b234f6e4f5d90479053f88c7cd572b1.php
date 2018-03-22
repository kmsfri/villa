<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i><?php echo $title; ?>

                <div class="pull-left">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">عملیات<span class="caret"></span></button>
                        <?php if($add_url!=Null || $del_url!=Null): ?>
                            <ul class="dropdown-menu pull-left" role="menu">
                                <?php if($add_url!=Null): ?> <li><a href="<?php echo e($add_url); ?>" class="btn btn-btn1-cs1">افزودن</a></li><?php endif; ?>
                                <?php if($del_url!=Null): ?>
                                    <li><a href="<?php echo e($del_url); ?>" onclick="$('#delForm').submit(); return false;" class="btn btn-btn1-cs1">حذف انتخاب شده ها</a></li>
                                    <form id="delForm" action="<?php echo e($del_url); ?>" method="post" onsubmit="return confirm('آیا از حذف موارد انتخاب شده مطمئنید؟');">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover list-table">
                                <?php echo $__env->yieldContent('content_list'); ?>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
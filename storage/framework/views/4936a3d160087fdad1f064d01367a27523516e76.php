<?php $__env->startSection('content_add_form'); ?>
    <div class="row">
    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 pull-right">
            <div class="checkbox">
                <label ><input type="checkbox" name="routes_assign_to_user[]"  value="<?php echo e($route->id); ?>" <?php echo e(($route->permited==1)? 'checked' : ''); ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($route->route_title); ?></label>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </br></br></br>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
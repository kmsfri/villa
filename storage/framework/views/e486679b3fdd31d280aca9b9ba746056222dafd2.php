<?php $__env->startSection('content_add_form'); ?>
    <div class="form-group<?php echo e($errors->has('villa_type_title') ? ' has-error' : ''); ?>">
        <label for="villa_type_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="villa_type_title" value="<?php echo e(old('villa_type_title',isset($villaType->villa_type_title) ? $villaType->villa_type_title : '')); ?>" autocomplete="off">
            <?php if($errors->has('villa_type_title')): ?><span class="help-block"><strong><?php echo e($errors->first('villa_type_title')); ?></strong></span><?php endif; ?>
        </div>
    </div>



    <div class="form-group<?php echo e($errors->has('villa_type_order') ? ' has-error' : ''); ?>">
        <label for="villa_type_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='villa_type_order' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=20; $i++): ?>
                    <option <?php if(old('villa_type_order' , isset($villaType->villa_type_order) ? $villaType->villa_type_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('villa_type_order')): ?> <span class="help-block"><strong><?php echo e($errors->first('villa_type_order')); ?></strong></span> <?php endif; ?>
        </div>
    </div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
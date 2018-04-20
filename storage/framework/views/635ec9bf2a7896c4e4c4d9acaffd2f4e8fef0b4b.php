<?php $__env->startSection('content_add_form'); ?>
    <?php if(count($errors)>0): ?>
        <?php echo e(dd($errors)); ?>

    <?php endif; ?>

    <input type="hidden" name="parent_id" value="<?php echo e(old('parent_id',isset($parent_id) ? $parent_id : Null)); ?>">
    <div class="form-group<?php echo e($errors->has('link_title') ? ' has-error' : ''); ?>">
        <label for="link_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="link_title" value="<?php echo e(old('link_title',isset($link->link_title) ? $link->link_title : '')); ?>">
            <?php if($errors->has('link_title')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('link_title')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>



    <div class="form-group<?php echo e($errors->has('link_url') ? ' has-error' : ''); ?>">
        <label for="link_url" class="col-md-2 pull-right control-label">لینک:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="link_url" value="<?php echo e(old('link_url',isset($link->link_url) ? $link->link_url : '')); ?>">
            <?php if($errors->has('link_url')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('link_url')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>




    <div class="form-group<?php echo e($errors->has('link_order') ? ' has-error' : ''); ?>">
        <label for="link_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='link_order' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=40; $i++): ?>
                    <option <?php if(old('link_order' , isset($link->link_order) ? $link->link_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('link_order')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('link_order')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('link_status') ? ' has-error' : ''); ?>">
        <label for="link_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='link_status' class='selectpicker form-control pull-right'>
                <option <?php if(old('link_status' , isset($link->link_status) ? $link->link_status : '')==1): ?> selected <?php endif; ?> value="1" >فعال</option>
                <option <?php if(old('link_status' , isset($link->link_status) ? $link->link_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
            </select>
            <?php if($errors->has('link_status')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('link_status')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
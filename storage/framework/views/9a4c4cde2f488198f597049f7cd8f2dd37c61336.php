<?php $__env->startSection('content_add_form'); ?>
    <input type="hidden" name="parent_id" value="<?php echo e(old('parent_id',isset($parent_id) ? $parent_id : Null)); ?>">
    <div class="form-group<?php echo e($errors->has('category_title') ? ' has-error' : ''); ?>">
        <label for="category_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="category_title" value="<?php echo e(old('category_title',isset($category->category_title) ? $category->category_title : '')); ?>">
            <?php if($errors->has('category_title')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_title')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('category_slug_corrected') ? ' has-error' : ''); ?>">
        <label for="category_slug" class="col-md-2 pull-right control-label">کلمات کلیدی آدرس:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="category_slug" value="<?php echo e(old('category_slug',isset($category->category_slug) ? $category->category_slug : '')); ?>">
            <?php if($errors->has('category_slug_corrected')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_slug_corrected')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>






    <div class="form-group<?php echo e($errors->has('category_order') ? ' has-error' : ''); ?>">
        <label for="category_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='category_order' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=40; $i++): ?>
                    <option <?php if(old('category_order' , isset($category->category_order) ? $category->category_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('category_order')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_order')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('category_status') ? ' has-error' : ''); ?>">
        <label for="category_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='category_status' class='selectpicker form-control pull-right'>
                <option <?php if(old('category_status' , isset($category->category_status) ? $category->category_status : '')==1): ?> selected <?php endif; ?> value="1" >فعال</option>
                <option <?php if(old('category_status' , isset($category->category_status) ? $category->category_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
            </select>
            <?php if($errors->has('category_status')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('category_status')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
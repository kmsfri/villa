<?php $__env->startSection('content_add_form'); ?>
    <input type="hidden" name="parent_id" value="<?php echo e(old('parent_id',isset($parent_id) ? $parent_id : Null)); ?>">
    <div class="form-group<?php echo e($errors->has('prop_title') ? ' has-error' : ''); ?>">
        <label for="prop_title" class="col-md-2 pull-right control-label"><?php echo e(($parent_id==Null)?'عنوان خصوصیت:' : 'مقدار:'); ?></label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="prop_title" value="<?php echo e(old('prop_title',isset($property->prop_title) ? $property->prop_title : '')); ?>">
            <?php if($errors->has('prop_title')): ?> <span class="help-block"><strong><?php echo e($errors->first('prop_title')); ?></strong></span> <?php endif; ?>
        </div>
    </div>

    <?php if(old('parent_id',isset($parent_id) ? $parent_id : Null)==Null): ?>
    <div class="form-group<?php echo e($errors->has('has_text_value') ? ' has-error' : ''); ?>">
        <label for="has_text_value" class="col-md-2 pull-right control-label">مقدار:</label>
        <div class="col-md-6 pull-right">
            <select  name='has_text_value' class='selectpicker form-control pull-right'>
                <option <?php if(old('has_text_value' , isset($property->has_text_value) ? $property->has_text_value : '')==0): ?> selected <?php endif; ?> value="0" >استاتیک</option>
                <option <?php if(old('has_text_value' , isset($property->has_text_value) ? $property->has_text_value : '')==1): ?> selected <?php endif; ?> value="1" >متنی</option>
            </select>
            <?php if($errors->has('has_text_value')): ?> <span class="help-block"><strong><?php echo e($errors->first('has_text_value')); ?></strong></span> <?php endif; ?>
        </div>
    </div>
    <div class="form-group<?php echo e($errors->has('guide_text') ? ' has-error' : ''); ?>">
        <label for="guide_text" class="col-md-2 pull-right control-label">متن راهنما:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="guide_text" value="<?php echo e(old('guide_text',isset($property->guide_text) ? $property->guide_text : '')); ?>">
            <?php if($errors->has('guide_text')): ?> <span class="help-block"><strong><?php echo e($errors->first('guide_text')); ?></strong></span> <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>







    <div class="form-group<?php echo e($errors->has('prop_order') ? ' has-error' : ''); ?>">
        <label for="prop_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='prop_order' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=20; $i++): ?>
                    <option <?php if(old('prop_order' , isset($property->prop_order) ? $property->prop_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('prop_order')): ?> <span class="help-block"><strong><?php echo e($errors->first('prop_order')); ?></strong></span> <?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('prop_status') ? ' has-error' : ''); ?>">
        <label for="prop_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='prop_status' class='selectpicker form-control pull-right'>
                <option <?php if(old('prop_status' , isset($property->prop_status) ? $property->prop_status : '')==1): ?> selected <?php endif; ?> value="1" >فعال</option>
                <option <?php if(old('prop_status' , isset($property->prop_status) ? $property->prop_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
            </select>
            <?php if($errors->has('prop_status')): ?> <span class="help-block"><strong><?php echo e($errors->first('prop_status')); ?></strong></span> <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content_add_form'); ?>
    <input type="hidden" name="parent_id" value="<?php echo e(old('parent_id',isset($parent_id) ? $parent_id : Null)); ?>">
    <div class="form-group<?php echo e($errors->has('city_name') ? ' has-error' : ''); ?>">
        <!-- change -->
        <label for="city_name" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="city_name" value="<?php echo e(old('city_name',isset($city->city_name) ? $city->city_name : '')); ?>">
            <?php if($errors->has('city_name')): ?>
                <span class="help-block">
                            <strong><?php echo e($errors->first('city_name')); ?></strong>
                        </span>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('city_description') ? ' has-error' : ''); ?>">
        <!-- change -->
        <label for="city_description" class="col-md-2 pull-right control-label">توضیحات:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" name="city_description"><?php echo e(old('city_description',isset($city->city_description) ? Helpers::br2nl($city->city_description) : '')); ?></textarea>
            <?php if($errors->has('city_description')): ?>
                <span class="help-block">
                            <strong><?php echo e($errors->first('city_description')); ?></strong>
                        </span>
            <?php endif; ?>
        </div>
    </div>




    <div class="form-group<?php echo e($errors->has('city_order') ? ' has-error' : ''); ?>">
        <!-- change -->
        <label for="city_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <!-- change -->
            <select  name='city_order' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=20; $i++): ?>
                    <option <?php if(old('city_order' , isset($city->city_order) ? $city->city_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('city_order')): ?>
                <span class="help-block">
                            <strong><?php echo e($errors->first('city_order')); ?></strong>
                        </span>
            <?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('city_status') ? ' has-error' : ''); ?>">
        <!-- change -->
        <label for="city_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <!-- change -->
            <select  name='city_status' class='selectpicker form-control pull-right'>
                <option <?php if(old('city_status' , isset($city->city_status) ? $city->city_status : '')==1): ?> selected <?php endif; ?> value="1" >فعال</option>
                <option <?php if(old('city_status' , isset($city->city_status) ? $city->city_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
            </select>
            <?php if($errors->has('city_status')): ?>
                <span class="help-block">
                            <strong><?php echo e($errors->first('city_status')); ?></strong>
                        </span>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
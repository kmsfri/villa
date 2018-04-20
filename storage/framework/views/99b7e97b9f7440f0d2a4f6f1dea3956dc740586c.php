<?php $__env->startSection('content_add_form'); ?>
    <div class="form-group<?php echo e($errors->has('tariff_title') ? ' has-error' : ''); ?>">
        <label for="tariff_title" class="col-md-2 pull-right control-label">عنوان تعرفه:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="tariff_title" value="<?php echo e(old('tariff_title',isset($tariff->tariff_title) ? $tariff->tariff_title : '')); ?>" autocomplete="off">
            <?php if($errors->has('tariff_title')): ?><span class="help-block"><strong><?php echo e($errors->first('tariff_title')); ?></strong></span><?php endif; ?>
        </div>
    </div>


    <div class="form-group<?php echo e($errors->has('tariff_duration') ? ' has-error' : ''); ?>">
        <label for="tariff_duration" class="col-md-2 pull-right control-label">مدت زمان:</label>
        <div class="col-md-6 pull-right">
            <select  name='tariff_duration' class='selectpicker form-control pull-right'>
                <?php for($i=1; $i<=90; $i++): ?>
                    <option <?php if(old('tariff_duration' , isset($tariff->tariff_duration) ? $tariff->tariff_duration : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?> روز</option>
                <?php endfor; ?>
            </select>
            <?php if($errors->has('tariff_duration')): ?> <span class="help-block"><strong><?php echo e($errors->first('tariff_duration')); ?></strong></span> <?php endif; ?>
        </div>
    </div>




    <div class="form-group<?php echo e($errors->has('tariff_price') ? ' has-error' : ''); ?>">
        <label for="tariff_price" class="col-md-2 pull-right control-label">قیمت(تومان):</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="tariff_price" value="<?php echo e(old('tariff_price',isset($tariff->tariff_price) ? $tariff->tariff_price : '')); ?>" autocomplete="off">
            <?php if($errors->has('tariff_price')): ?><span class="help-block"><strong><?php echo e($errors->first('tariff_price')); ?></strong></span><?php endif; ?>
        </div>
    </div>



    <div class="form-group<?php echo e($errors->has('tariff_needed_points') ? ' has-error' : ''); ?>">
        <label for="tariff_needed_points" class="col-md-2 pull-right control-label">امتیاز مورد نیاز:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="tariff_needed_points" value="<?php echo e(old('tariff_needed_points',isset($tariff->tariff_needed_points) ? $tariff->tariff_needed_points : '')); ?>" autocomplete="off">
            <?php if($errors->has('tariff_needed_points')): ?><span class="help-block"><strong><?php echo e($errors->first('tariff_needed_points')); ?></strong></span><?php endif; ?>
        </div>
    </div>





    <div class="form-group<?php echo e($errors->has('tariff_status') ? ' has-error' : ''); ?>">
        <label for="tariff_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='tariff_status' class='selectpicker form-control pull-right' autocomplete="off">
                <option <?php if(old('tariff_status' ,isset($tariff->tariff_status) ? $tariff->tariff_status : '' )==1): ?> selected <?php endif; ?> value="1" >فعال</option>
                <option <?php if(old('tariff_status' , isset($tariff->tariff_status) ? $tariff->tariff_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
            </select>
            <?php if($errors->has('tariff_status')): ?><span class="help-block"><strong><?php echo e($errors->first('tariff_status')); ?></strong></span><?php endif; ?>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content_add_form'); ?>
<div class="form-group<?php echo e($errors->has('s_title') ? ' has-error' : ''); ?>">
    <label for="s_title" class="col-md-2 pull-right control-label">عنوان:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="s_title" value="<?php echo e(old('s_title',isset($s->s_title) ? $s->s_title : '')); ?>" autocomplete="off">
        <?php if($errors->has('s_title')): ?>
            <span class="help-block">
                            <strong><?php echo e($errors->first('s_title')); ?></strong>
                        </span>
        <?php endif; ?>
    </div>
</div>



<div class="form-group<?php echo e($errors->has('img_dir') ? ' has-error' : ''); ?>">
    <label for="img_dir" class="col-md-2 pull-right control-label">تصویر آیکن:</label>
    <div class="col-md-4 pull-right">
        <input type="file" onchange="readURL(this,'','admin_img_preview')" name="img_dir" id="img_dir" value="<?php echo e(old('img_dir',isset($s->img_dir) ? $s->img_dir : '')); ?>" autocomplete="off">
        <?php if($errors->has('img_dir')): ?> <span class="help-block"><strong><?php echo e($errors->first('img_dir')); ?></strong></span> <?php endif; ?>
    </div>
    <div class="col-md-4 pull-right">
        <img id="admin_img_preview" class="<?php echo e(isset($s->img_dir) ? '' : 'hide'); ?>" src="<?php echo e(isset($s->img_dir) ? url($s->img_dir) : '#'); ?>" alt="تصویر پروفایل" autocomplete="off" />
    </div>
</div>



<div class="form-group<?php echo e($errors->has('s_link') ? ' has-error' : ''); ?>">
    <label for="s_link" class="col-md-2 pull-right control-label">لینک :</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="s_link" value="<?php echo e(old('s_link',isset($s->s_link) ? $s->s_link : '')); ?>" autocomplete="off">
        <?php if($errors->has('s_link')): ?>
            <span class="help-block">
                            <strong><?php echo e($errors->first('s_link')); ?></strong>
                        </span>
        <?php endif; ?>
    </div>
</div>


<div class="form-group<?php echo e($errors->has('s_order') ? ' has-error' : ''); ?>">
    <label for="s_order" class="col-md-2 pull-right control-label">اولویت</label>
    <div class="col-md-6 pull-right">
        <select  name='s_order' class='selectpicker form-control pull-right' autocomplete="off">
            <?php for($i=1; $i<=40; $i++): ?>
                <option <?php if(old('s_order' , isset($s->s_order) ? $s->s_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>" ><?php echo e($i); ?></option>
            <?php endfor; ?>
        </select>
        <?php if($errors->has('s_order')): ?>
            <span class="help-block">
                            <strong><?php echo e($errors->first('s_order')); ?></strong>
                        </span>
        <?php endif; ?>
    </div>
</div>
<div class="form-group<?php echo e($errors->has('s_status') ? ' has-error' : ''); ?>">
    <label for="s_status" class="col-md-2 pull-right control-label">وضعیت</label>
    <div class="col-md-6 pull-right">
        <select  name='s_status' class='selectpicker form-control pull-right' autocomplete="off">
            <option <?php if(old('s_status' , isset($s->s_status) ? $s->s_status : '')==1): ?> selected <?php endif; ?> value="1" >فعال</option>
            <option <?php if(old('s_status' , isset($s->s_status) ? $s->s_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
        </select>
        <?php if($errors->has('s_status')): ?>
            <span class="help-block">
                            <strong><?php echo e($errors->first('s_status')); ?></strong>
                        </span>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content_add_form'); ?>
<div class="form-group<?php echo e($errors->has('user_name') ? ' has-error' : ''); ?>">
    <label for="user_name" class="col-md-2 pull-right control-label">نام کاربری:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="user_name" value="<?php echo e(old('user_name',isset($u->user_name) ? $u->user_name : '')); ?>" autocomplete="off">
        <?php if($errors->has('user_name')): ?><span class="help-block"><strong><?php echo e($errors->first('user_name')); ?></strong></span><?php endif; ?>
    </div>
</div>

<div class="form-group<?php echo e($errors->has('user_title') ? ' has-error' : ''); ?>">
    <label for="user_title" class="col-md-2 pull-right control-label">نام و نام خانوادگی:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="user_title" value="<?php echo e(old('user_title',isset($u->user_title) ? $u->user_title : '')); ?>" autocomplete="off">
        <?php if($errors->has('user_title')): ?><span class="help-block"><strong><?php echo e($errors->first('user_title')); ?></strong></span><?php endif; ?>
    </div>
</div>

<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
    <label for="email" class="col-md-2 pull-right control-label">ایمیل:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="email" value="<?php echo e(old('email',isset($u->email) ? $u->email : '')); ?>" autocomplete="off">
        <?php if($errors->has('email')): ?><span class="help-block"><strong><?php echo e($errors->first('email')); ?></strong></span><?php endif; ?>
    </div>
</div>

<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
    <label for="password" class="col-md-2 pull-right control-label">رمز عبور:</label>
    <div class="col-md-6 pull-right">
        <input type="password" class="form-control" name="password" value="<?php echo e(old('password',isset($u->password) ? '**||password-no-changed' : '')); ?>" autocomplete="off">
        <?php if($errors->has('password')): ?><span class="help-block"><strong><?php echo e($errors->first('password')); ?></strong></span><?php endif; ?>
    </div>
</div>

<div class="form-group<?php echo e($errors->has('avatar_dir') ? ' has-error' : ''); ?>">
    <label for="avatar_dir" class="col-md-2 pull-right control-label">تصویر پروفایل:</label>
    <div class="col-md-4 pull-right">
        <input type="file" onchange="readURL(this,'','admin_img_preview')" name="avatar_dir" id="avatar_dir" value="<?php echo e(old('avatar_dir',isset($u->avatar_dir) ? $u->avatar_dir : '')); ?>" autocomplete="off">
        <?php if($errors->has('avatar_dir')): ?> <span class="help-block"><strong><?php echo e($errors->first('avatar_dir')); ?></strong></span> <?php endif; ?>
    </div>
    <div class="col-md-4 pull-right">
        <img id="admin_img_preview" class="<?php echo e(isset($u->avatar_dir) ? '' : 'hide'); ?>" src="<?php echo e(isset($u->avatar_dir) ? url('admin/uploads/users/'.$u->avatar_dir) : '#'); ?>" alt="تصویر پروفایل" autocomplete="off" />
    </div>
</div>

<div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
    <label for="description" class="col-md-2 pull-right control-label">توضیحات:</label>
    <div class="col-md-6 pull-right">
        <textarea class="form-control" name="description"><?php echo e(old('description',isset($u->description) ? Helpers::br2nl($u->description) : '')); ?></textarea>
        <?php if($errors->has('description')): ?><span class="help-block"><strong><?php echo e($errors->first('description')); ?></strong></span><?php endif; ?>
    </div>
</div>

<div class="form-group<?php echo e($errors->has('user_status') ? ' has-error' : ''); ?>">
    <label for="user_status" class="col-md-2 pull-right control-label">وضعیت:</label>
    <div class="col-md-6 pull-right">
        <select  name='user_status' class='selectpicker form-control pull-right' autocomplete="off">
            <option <?php if(old('user_status' ,isset($u->user_status) ? $u->user_status : '' )==1): ?> selected <?php endif; ?> value="1" >فعال</option>
            <option <?php if(old('user_status' , isset($u->user_status) ? $u->user_status : '')==0): ?> selected <?php endif; ?> value="0" >غیر فعال</option>
        </select>
        <?php if($errors->has('user_status')): ?><span class="help-block"><strong><?php echo e($errors->first('user_status')); ?></strong></span><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsCustom'); ?>
<script type="text/javascript">
    function readURL(input,img_id,img_preview_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#'+img_preview_id+img_id)
                    .attr('src', e.target.result)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
            $('#'+img_preview_id+img_id).removeClass('hide');
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
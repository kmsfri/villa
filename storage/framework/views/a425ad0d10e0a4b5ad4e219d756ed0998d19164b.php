<?php $__env->startSection('content_add_form'); ?>
    <div class="form-group<?php echo e($errors->has('mobile_number') ? ' has-error' : ''); ?>">
        <label for="mobile_number" class="col-md-2 pull-right control-label">شماره موبایل:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="mobile_number" value="<?php echo e(old('mobile_number',isset($u->mobile_number) ? $u->mobile_number : '')); ?>" autocomplete="off">
            <?php if($errors->has('mobile_number')): ?><span class="help-block"><strong><?php echo e($errors->first('mobile_number')); ?></strong></span><?php endif; ?>
        </div>
    </div>
    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
        <label for="password" class="col-md-2 pull-right control-label">رمز عبور:</label>
        <div class="col-md-6 pull-right">
            <input type="password" class="form-control" name="password" value="<?php echo e(old('password',isset($u->password) ? '**||password-no-changed' : '')); ?>" autocomplete="off">
            <?php if($errors->has('password')): ?><span class="help-block"><strong><?php echo e($errors->first('password')); ?></strong></span><?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('fullname') ? ' has-error' : ''); ?>">
        <label for="fullname" class="col-md-2 pull-right control-label">نام کامل:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="fullname" value="<?php echo e(old('fullname',isset($u->fullname) ? $u->fullname : '')); ?>" autocomplete="off">
            <?php if($errors->has('fullname')): ?><span class="help-block"><strong><?php echo e($errors->first('fullname')); ?></strong></span><?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('avatar_dir') ? ' has-error' : ''); ?>">
        <label for="avatar_dir" class="col-md-2 pull-right control-label">تصویر پروفایل:</label>
        <div class="col-md-4 pull-right">
            <input type="file" onchange="readURL(this,'','img_preview')" name="avatar_dir" id="avatar_dir" value="<?php echo e(old('avatar_dir',isset($u->avatar_dir) ? $u->avatar_dir : '')); ?>" autocomplete="off">
            <?php if($errors->has('avatar_dir')): ?> <span class="help-block"><strong><?php echo e($errors->first('avatar_dir')); ?></strong></span> <?php endif; ?>
        </div>
        <div class="col-md-4 pull-right">
            <img id="img_preview" class="<?php echo e(isset($u->avatar_dir) ? '' : 'hide'); ?>" src="<?php echo e(isset($u->avatar_dir) ? url('/images/users/user-uploads/user-pics/'.$u->avatar_dir) : '#'); ?>" alt="تصویر پروفایل" autocomplete="off" />
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
        <label for="address" class="col-md-2 pull-right control-label">آدرس:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="address" value="<?php echo e(old('address',isset($u->address) ? $u->address : '')); ?>" autocomplete="off">
            <?php if($errors->has('address')): ?><span class="help-block"><strong><?php echo e($errors->first('address')); ?></strong></span><?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('blog_title') ? ' has-error' : ''); ?>">
        <label for="blog_title" class="col-md-2 pull-right control-label">عنوان بلاگ:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="blog_title" value="<?php echo e(old('blog_title',isset($u->blog_title) ? $u->blog_title : '')); ?>" autocomplete="off">
            <?php if($errors->has('blog_title')): ?><span class="help-block"><strong><?php echo e($errors->first('blog_title')); ?></strong></span><?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('blog_description') ? ' has-error' : ''); ?>">
        <label for="blog_description" class="col-md-2 pull-right control-label">توضیحات بلاگ:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" name="blog_description"><?php echo e(old('blog_description',isset($u->blog_description) ? Helpers::br2nl($u->blog_description) : '')); ?></textarea>
            <?php if($errors->has('blog_description')): ?><span class="help-block"><strong><?php echo e($errors->first('blog_description')); ?></strong></span><?php endif; ?>
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

    <div class="form-group<?php echo e($errors->has('profile_slug') ? ' has-error' : ''); ?>">
        <label for="profile_slug" class="col-md-2 pull-right control-label">آدرس بلاگ:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="profile_slug" value="<?php echo e(old('profile_slug',isset($u->profile_slug) ? $u->profile_slug : '')); ?>" autocomplete="off">
            <?php if($errors->has('profile_slug')): ?><span class="help-block"><strong><?php echo e($errors->first('profile_slug')); ?></strong></span><?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('instagram_link') ? ' has-error' : ''); ?>">
        <label for="instagram_link" class="col-md-2 pull-right control-label">لینک اینستاگرام:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="instagram_link" value="<?php echo e(old('instagram_link',isset($u->instagram_link) ? $u->instagram_link : '')); ?>" autocomplete="off">
            <?php if($errors->has('instagram_link')): ?><span class="help-block"><strong><?php echo e($errors->first('instagram_link')); ?></strong></span><?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('telegram_link') ? ' has-error' : ''); ?>">
        <label for="telegram_link" class="col-md-2 pull-right control-label">لینک تلگرام:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="telegram_link" value="<?php echo e(old('telegram_link',isset($u->telegram_link) ? $u->telegram_link : '')); ?>" autocomplete="off">
            <?php if($errors->has('telegram_link')): ?><span class="help-block"><strong><?php echo e($errors->first('telegram_link')); ?></strong></span><?php endif; ?>
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
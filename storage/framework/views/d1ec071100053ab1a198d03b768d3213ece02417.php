<?php $__env->startSection('formBody'); ?>
<div class="box-panel padding">
    <div class="header">
        <h3 class="title-box">اطلاعات نوشتاری بلاگ</h3><br>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>* عنوان بلاگ</label>
                    <input class="form-control" type="text" value="<?php echo e(old('blog_title',isset($user->blog_title) ? $user->blog_title : '')); ?>" name="blog_title" required>
                    <?php if($errors->has('blog_title')): ?> <span class="help-block"><strong><?php echo e($errors->first('blog_title')); ?></strong></span> <?php endif; ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>* توضیحات بلاگ</label>
                    <input class="form-control" type="text" value="<?php echo e(old('blog_description',isset($user->blog_description) ? $user->blog_description : '')); ?>" name="blog_description" required>
                    <?php if($errors->has('blog_description')): ?> <span class="help-block"><strong><?php echo e($errors->first('blog_description')); ?></strong></span> <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-panel">
    <div class="header">
        <h3 class="title-box">آدرس های شبکه اجتماعی</h3><br>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> تلگرام</label>
                    <div class="input-group">
                        <input class="form-control" aria-describedby="telegram" type="text" name="telegram_link" value="<?php echo e(old('telegram_link',isset($user->telegram_link) ? $user->telegram_link : '')); ?>">

                        <span class="input-group-addon" id="telegram">https://t.me/</span>
                    </div>
                    <?php if($errors->has('telegram_link')): ?> <span class="help-block"><strong><?php echo e($errors->first('telegram_link')); ?></strong></span> <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> اینستاگرام</label>
                    <div class="input-group">
                        <input class="form-control" type="text" aria-describedby="instagram" name="instagram_link" value="<?php echo e(old('instagram_link',isset($user->instagram_link) ? $user->instagram_link : '')); ?>">

                        <span class="input-group-addon" id="instagram">https://instagram.com/</span>
                    </div>
                    <?php if($errors->has('instagram_link')): ?> <span class="help-block"><strong><?php echo e($errors->first('instagram_link')); ?></strong></span> <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.masterForms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
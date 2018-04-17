<?php $__env->startSection('content_add_form'); ?>


    <div class="form-group<?php echo e($errors->has('comment_text') ? ' has-error' : ''); ?>">
        <label for="comment_text" class="col-md-2 pull-right control-label">متن نظر:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" rows="10" name="comment_text"><?php echo e(old('comment_text',isset($comment->comment_text) ? Helpers::br2nl($comment->comment_text) : '')); ?></textarea>
            <?php if($errors->has('comment_text')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('comment_text')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('comment_status') ? ' has-error' : ''); ?>">
        <label for="comment_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='comment_status' class='selectpicker form-control pull-right' autocomplete="off">
                <option <?php if(old('comment_status' , isset($comment->comment_status) ? $comment->comment_status : '')==0): ?> selected <?php endif; ?> value="0" >جدید</option>
                <option <?php if(old('comment_status' ,isset($comment->comment_status) ? $comment->comment_status : '' )==1): ?> selected <?php endif; ?> value="1" >بررسی شده</option>
                <option <?php if(old('comment_status' ,isset($comment->comment_status) ? $comment->comment_status : '' )==2): ?> selected <?php endif; ?> value="2" >پذیرفته شده</option>
                <option <?php if(old('comment_status' ,isset($comment->comment_status) ? $comment->comment_status : '' )==3): ?> selected <?php endif; ?> value="3" >رد شده</option>
            </select>
            <?php if($errors->has('comment_status')): ?><span class="help-block"><strong><?php echo e($errors->first('comment_status')); ?></strong></span><?php endif; ?>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
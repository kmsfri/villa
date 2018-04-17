<?php $__env->startSection('content_add_form'); ?>


    <div class="form-group<?php echo e($errors->has('report_text') ? ' has-error' : ''); ?>">
        <label for="report_text" class="col-md-2 pull-right control-label">متن گزارش:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" rows="10" name="report_text"><?php echo e(old('report_text',isset($report->report_text) ? Helpers::br2nl($report->report_text) : '')); ?></textarea>
            <?php if($errors->has('report_text')): ?>
                <span class="help-block"><strong><?php echo e($errors->first('report_text')); ?></strong></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('report_status') ? ' has-error' : ''); ?>">
        <label for="report_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='report_status' class='selectpicker form-control pull-right' autocomplete="off">
                <option <?php if(old('report_status' , isset($report->report_status) ? $report->report_status : '')==0): ?> selected <?php endif; ?> value="0" >جدید</option>
                <option <?php if(old('report_status' ,isset($report->report_status) ? $report->report_status : '' )==1): ?> selected <?php endif; ?> value="1" >بررسی شده</option>
                <option <?php if(old('report_status' ,isset($report->report_status) ? $report->report_status : '' )==2): ?> selected <?php endif; ?> value="2" >پذیرفته شده</option>
                <option <?php if(old('report_status' ,isset($report->report_status) ? $report->report_status : '' )==3): ?> selected <?php endif; ?> value="3" >رد شده</option>
            </select>
            <?php if($errors->has('report_status')): ?><span class="help-block"><strong><?php echo e($errors->first('report_status')); ?></strong></span><?php endif; ?>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
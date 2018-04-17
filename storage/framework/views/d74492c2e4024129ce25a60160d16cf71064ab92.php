<?php $__env->startSection('content_add_form'); ?>

    <input type="hidden" name="renter_user_id" value="<?php echo e(old('renter_user_id',isset($renter_user_id) ? $renter_user_id : '')); ?>" autocomplete="off">
    <input type="hidden" name="ticket_id" value="<?php echo e(old('ticket_id',isset($ticket) ? $ticket->id : '')); ?>" autocomplete="off">
    <div class="main-panel">

    <?php $__currentLoopData = $ticketMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tM): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="box-panel padding">
        <div class="box-panel">
            <div class="header">
                <div class="row">
                    <div class="col-md-6 pull-right">
                        فرستنده: <?php echo e(($tM->sender!=0)?'مدیریت سیستم':$user->mobile_number); ?>

                    </div>
                    <div class="col-md-6 pull-right">
                        <?php echo e(Helpers::convert_date_g_to_j($tM->created_at,true)); ?> - <?php echo e($tM->created_at->format('H:i:s')); ?>

                    </div>
                </div>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12 pull-right">
                        <p><?php echo $tM->message_text; ?></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>







    <div class="box-panel padding">
    <div class="box-panel">
        <div class="header">
            <h3 class="title-box">ارسال پاسخ</h3>
        </div>
        <div class="data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea rows="5" class="form-control" name="message_text" placeholder="متن پیام را اینجا بنویسید" autocomplete="off"><?php echo e(old('message_text',isset($ticket->message_text) ? Helpers::br2nl($ticket->message_text) : '')); ?></textarea>
                        <?php if($errors->has('message_text')): ?><span class="help-block"><strong><?php echo e($errors->first('message_text')); ?></strong></span><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    <div class="box-panel padding">
        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">وضعیت</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group<?php echo e($errors->has('ticket_status') ? ' has-error' : ''); ?>">
                            <select  name='ticket_status' class='selectpicker form-control pull-right' autocomplete="off">
                                <option <?php if(old('ticket_status' ,isset($ticket->ticket_status) ? $ticket->ticket_status : '' )==1): ?> selected <?php endif; ?> value="1" >بسته شده</option>
                                <option <?php if(old('ticket_status' , isset($ticket->ticket_status) ? $ticket->ticket_status : '')==0): ?> selected <?php endif; ?> value="0" >باز</option>
                            </select>
                            <?php if($errors->has('ticket_status')): ?><span class="help-block"><strong><?php echo e($errors->first('tariff_status')); ?></strong></span><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
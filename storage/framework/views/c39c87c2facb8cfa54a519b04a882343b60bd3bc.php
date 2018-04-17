<?php $__env->startSection('formBody'); ?>
    <input type="hidden" name="ticket_id" value="<?php echo e(old('ticket_id',isset($ticket) ? $ticket->id : '')); ?>" autocomplete="off">



            <?php $__currentLoopData = $ticketMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tM): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





    <?php if(!isset($ticket) || $ticket->ticket_status==0): ?>
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
    <?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.panel.masterForms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <th style="width: 1px;" class="text-center"></th>
        <th scope="col" class="text-center">کد تیکت</th>
        <th scope="col" class="text-center">تاریخ ایجاد تیکت</th>
        <th scope="col" class="text-center">تاریخ بروزرسانی</th>
        <th scope="col" class="text-center">وضعیت</th>
        <th scope="col" class="text-center">عملیات</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($tc->id); ?>" type="checkbox">
            </td>
            <th class="number text-center" scope="row"><?php echo e($tc->id); ?></th>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($tc->created_at,true)); ?> - <?php echo e($tc->created_at->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($tc->updated_at,true)); ?> - <?php echo e($tc->updated_at->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="situation <?php echo e(($tc->ticket_status==0)?'active':''); ?>">
                    <?php echo e(($tc->ticket_status==0)?'باز':'بسته شده'); ?>

                </p>
            </td>
            <td class="text-center"><a href="<?php echo e(Route('adminTicketMessages',$tc->id)); ?>">مشاهده</a></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
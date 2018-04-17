<?php $__env->startSection('tableBody'); ?>
    <thead>
    <tr>
        <th scope="col">کد تیکت</th>
        <th scope="col">تاریخ ایجاد تیکت</th>
        <th scope="col">تاریخ بروزرسانی</th>
        <th scope="col">وضعیت</th>
        <th scope="col">عملیات</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th class="number" scope="row"><?php echo e($tc->id); ?></th>
            <td>
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($tc->created_at,true)); ?> - <?php echo e($tc->created_at->format('H:i:s')); ?></p>
            </td>
            <td>
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($tc->updated_at,true)); ?> - <?php echo e($tc->updated_at->format('H:i:s')); ?></p>
            </td>
            <td>
                <p class="situation <?php echo e(($tc->ticket_status==0)?'active':''); ?>">
                    <?php echo e(($tc->ticket_status==0)?'باز':'بسته شده'); ?>

                </p>
            </td>
            <td><a href="<?php echo e(Route('ticketMessages',$tc->id)); ?>">مشاهده</a></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagination'); ?>
    <div class="pagination pull-left"><?php echo str_replace('/?', '?', $tickets->render()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.masterLists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
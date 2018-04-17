<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <th style="width: 1px;" class="text-center"></th>
        <th scope="col" class="text-center">گزارش دهنده</th>
        <th scope="col" class="text-center">کد ویلا</th>
        <th scope="col" class="text-center">تاریخ ثبت</th>
        <th scope="col" class="text-center">تاریخ بروزرسانی</th>
        <th scope="col" class="text-center">وضعیت</th>
        <th scope="col" class="text-center">عملیات</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($rp->id); ?>" type="checkbox">
            </td>

            <td class="text-center">
                <p class="text"><?php echo e(isset($rp->mobile_number)?$rp->mobile_number:$rp->RenterUser()->first()->mobile_number); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e($rp->villa_id); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($rp->created_at,true)); ?> - <?php echo e(\Carbon\Carbon::parse($rp->created_at)->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($rp->updated_at,true)); ?> - <?php echo e(\Carbon\Carbon::parse($rp->updated_at)->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="situation <?php echo e(($rp->report_status==0)?'active':''); ?>">
                    <?php
                        $rp_status=[
                            0=>'جدید',
                            1=>'بررسی شده',
                            2=>'پذیرفته شده',
                            3=>'رد شده',
                        ];
                    ?>
                    <?php echo e($rp_status[$rp->report_status]); ?>

                </p>
            </td>
            <td class="text-center"><a href="<?php echo e(Route('editReport',$rp->id)); ?>">مشاهده</a></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
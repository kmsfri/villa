<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <th style="width: 1px;" class="text-center"></th>
        <th scope="col" class="text-center">نظر دهنده</th>
        <th scope="col" class="text-center">تاریخ ثبت</th>
        <th scope="col" class="text-center">تاریخ بروزرسانی</th>
        <th scope="col" class="text-center">وضعیت</th>
        <th scope="col" class="text-center">عملیات</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($cm->id); ?>" type="checkbox">
            </td>

            <td class="text-center">
                <p class="text"><?php echo e(isset($cm->mobile_number)?$cm->mobile_number:$cm->WritenBy()->first()->mobile_number); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($cm->created_at,true)); ?> - <?php echo e(\Carbon\Carbon::parse($cm->created_at)->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($cm->updated_at,true)); ?> - <?php echo e(\Carbon\Carbon::parse($cm->updated_at)->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="situation <?php echo e(($cm->comment_status==0)?'active':''); ?>">
                    <?php
                        $cm_status=[
                            0=>'جدید',
                            1=>'بررسی شده',
                            2=>'پذیرفته شده',
                            3=>'رد شده',
                        ];
                    ?>
                    <?php echo e($cm_status[$cm->comment_status]); ?>

                </p>
            </td>
            <td class="text-center"><a href="<?php echo e(Route('editWebsiteComment',$cm->id)); ?>">مشاهده</a></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
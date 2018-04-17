<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">شماره موبایل</td>
        <td class="text-center">نام کامل</td>
        <td class="text-center">لینک صفحه شخصی</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>
    </thead>
    <tbody>
    <?php $c=1; ?>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($u->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                    <?php echo e($c); ?> <?php $c++; ?>
            </td>
            <td class="text-center">
                <?php echo e($u->mobile_number); ?>

            </td>
            <td class="text-center">
                <?php echo e(($u->fullname!=Null)?$u->fullname:'-'); ?>

            </td>
            <td class="text-center">
                <?php if($u->profile_slug!=Null): ?>
                    <a href="<?php echo e(url($u->profile_slug)); ?>" target="_blank">
                        <?php echo e($u->profile_slug); ?>

                    </a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td class="text-center">
                <?php echo e(($u->user_status==1)?'فعال':'غیرفعال'); ?>

            </td>
            <td class="text-center">
                <a href="<?php echo e(url(Route('edit_renter_form',$u->id))); ?>" data-toggle="tooltip" title="ویرایش کاربر">
                    ویرایش کاربر
                </a>|
                <a href="<?php echo e(url(Route('adminShowVillaList',$u->id))); ?>" data-toggle="tooltip" title="ویلاها">
                    ویلاها
                </a>|
                <a href="<?php echo e(url(Route('adminAddVillaForm',$u->id))); ?>" data-toggle="tooltip" title="افزودن ویلا">
                    افزودن ویلا
                </a>|
                <a href="<?php echo e(url(Route('adminTicketList',$u->id))); ?>" data-toggle="tooltip" title="افزودن ویلا">
                    تیکتها
                </a>


            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
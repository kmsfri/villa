<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">عنوان</td>
        <td class="text-center">زمان</td>
        <td class="text-center">قیمت</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>

    </thead>
    <tbody>
    <?php $c=1; ?>
    <?php $__currentLoopData = $tariffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($trf->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                    <?php echo e($c); ?> <?php $c++; ?>
            </td>
            <td class="text-center">
                    <?php echo e($trf->tariff_title); ?>

            </td>
            <td class="text-center">
                    <?php echo e($trf->tariff_duration); ?> روز
            </td>
            <td class="text-center">
                <?php echo e($trf->tariff_price); ?> تومان
            </td>
            <td class="text-center">
                <?php echo e(($trf->tariff_status==1)?'فعل':'غیرفعال'); ?>

            </td>
            <td class="text-center">
                <a href="<?php echo e(Route('editTariff',$trf->id)); ?>" data-toggle="tooltip" title="ویرایش تعرفه">
                    ویرایش تعرفه
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
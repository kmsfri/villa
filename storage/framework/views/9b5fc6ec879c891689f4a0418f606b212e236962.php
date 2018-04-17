<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">عنوان</td>
        <td class="text-center">عملیات</td>
    </tr>

    </thead>
    <tbody>
    <?php $c=1; ?>
    <?php $__currentLoopData = $villaTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($vt->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <?php echo e($c); ?> <?php $c++; ?>
            </td>
            <td class="text-center">
                <?php echo e($vt->villa_type_title); ?>

            </td>
            <td class="text-center">
                <a href="<?php echo e(Route('editVillaType',$vt->id)); ?>" data-toggle="tooltip" title="ویرایش نوع ویلا">
                    ویرایش نوع ویلا
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
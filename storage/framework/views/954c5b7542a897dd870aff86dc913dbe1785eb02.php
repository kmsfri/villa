<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">عنوان</td>
        <td class="text-center">ثبت کننده</td>
        <td class="text-center">لینک صفحه شخصی</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>
    </thead>
    <tbody>
    <?php $c=1; ?>
    <?php $__currentLoopData = $villas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($v->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <?php echo e($c); ?> <?php $c++; ?>
            </td>
            <td class="text-center">
                <?php echo e($v->villa_title); ?>

            </td>
            <td class="text-center">
                <?php echo e($v->RenterUser()->first()->mobile_number); ?>

            </td>
            <td class="text-center">
                <?php if($v->villa_slug!=Null): ?>
                    <a href="<?php echo e(url($v->villa_slug)); ?>" target="_blank">
                        <?php echo e($v->villa_slug); ?>

                    </a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td class="text-center">
                <?php echo e(($v->villa_status==1)?'تایید شده':'تایید نشده'); ?>

            </td>
            <td class="text-center">
                <a href="<?php echo e(url(Route('adminEditVillaForm',$v->id))); ?>" data-toggle="tooltip" title="ویرایش ویلا">
                    ویرایش
                </a>|<a href="<?php echo e(url(Route('adminEditVillaCategory',$v->id))); ?>" data-toggle="tooltip" title="ویرایش دسته بندیها">
                    دسته بندیها
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('paginationContainer'); ?>
    <?php echo e($villas->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
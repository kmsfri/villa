<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-left">
            <center>
                ردیف
            </center>
        </td>
        <td class="text-left">
            <center>
                نام
            </center>
        </td>
        <td class="text-right">
            <center>
                وضعیت
            </center>
        </td>
        <td class="text-right">
            <center>
                عملیات
            </center>
        </td>

    </tr>

    </thead>
    <tbody>
    <?php $c=1; ?>
    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($city->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    <?php echo e($c); ?> <?php $c++; ?>
                </center>
            </td>
            <td class="text-center">
                <center>
                    <?php if($canHasSubCity): ?>
                        <a href="<?php echo e(url(Route('cities-list',$city->id))); ?>">
                    <?php endif; ?>
                            <?php echo e($city->city_name); ?>

                    <?php if($canHasSubCity==Null): ?>
                        </a>
                    <?php endif; ?>


                </center>
            </td>
            <td class="text-center">
                <center>
                    <?php if($city->city_status==1): ?>
                        فعال
                    <?php else: ?>
                        غیر فعال
                    <?php endif; ?>
                </center>
            </td>

            <td class="text-center">
                <a href="<?php echo e(url(Route('edit-city-form',$city->id))); ?>">
                    ویرایش
                </a>
            </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
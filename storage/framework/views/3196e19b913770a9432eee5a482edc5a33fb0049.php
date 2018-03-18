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
                عنوان
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
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($ctg->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    <?php echo e($c); ?> <?php $c++; ?>
                </center>
            </td>
            <td class="text-center">
                <center>
                    <?php if($canHasSubCategory): ?><a href="<?php echo e(url(Route('categories3-list',$ctg->id))); ?>"><?php endif; ?>
                            <?php echo e($ctg->category_title); ?>

                    <?php if($canHasSubCategory==Null): ?></a><?php endif; ?>


                </center>
            </td>
            <td class="text-center">
                <center>
                    <?php if($ctg->category_status==1): ?>
                        فعال
                    <?php else: ?>
                        غیر فعال
                    <?php endif; ?>
                </center>
            </td>

            <td class="text-center">
                <a href="<?php echo e(url(Route('edit-category3-form',$ctg->id))); ?>">
                    ویرایش
                </a>
            </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
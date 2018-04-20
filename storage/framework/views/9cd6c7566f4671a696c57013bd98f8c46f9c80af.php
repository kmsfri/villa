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
    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($link->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                    <?php echo e($c); ?> <?php $c++; ?>
            </td>
            <td class="text-center">
                    <?php if($canHasSubCategory): ?><a href="<?php echo e(url(Route('footerLink_list',$link->id))); ?>"><?php endif; ?>
                        <?php echo e($link->link_title); ?>

                    <?php if($canHasSubCategory==Null): ?></a><?php endif; ?>
            </td>
            <td class="text-center">
                    <?php echo e(($link->link_status==1)?'فعال':'غیرفعال'); ?>

            </td>

            <td class="text-center">
                <a href="<?php echo e(Route(  ((isset($type) && $type='menuLinks')?'edit_menuLink_form':'edit_footerLink_form'),$link->id)); ?>">
                    ویرایش
                </a>
            </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center"><?php echo e(($parent_id==Null)?'عنوان خصوصیت':'مقدار خصوصیت'); ?></td>
        <td class="text-center">مقدار</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>
    </thead>
    <tbody>
    <?php $c=1; ?>
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($prop->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <?php echo e($c); ?> <?php $c++; ?>
            </td>
            <td class="text-center">
            <?php if($canHasSubProp && $prop->has_text_value==0): ?>
                <a href="<?php echo e(url(Route('propertiesList',$prop->id))); ?>">
            <?php endif; ?>
                    <?php echo e($prop->prop_title); ?>

            <?php if($canHasSubProp && $prop->has_text_value==0): ?>
                </a>
            <?php endif; ?>
            </td>
            <td class="text-center">
                <?php echo e(($prop->has_text_value==1)?'متنی':'استاتیک'); ?>

            </td>
            <td class="text-center">
                <?php echo e(($prop->prop_status==1)?'فعال':'غیرفعال'); ?>

            </td>
            <td class="text-center">
                <a href="<?php echo e(url(Route('editPropertyForm',$prop->id))); ?>">ویرایش</a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                تصویر
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
    <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($s->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    <?php echo e($c); ?> <?php $c++; ?>
                </center>
            </td>
            <td class="text-center">
                <center>
                    <?php if(file_exists(public_path().$s->img_dir)): ?>
                        <img style="margin-top:1px;max-height:34px;" src="<?php echo e(url($s->img_dir)); ?>">
                    <?php else: ?>
                        <span>بدون تصویر</span>
                    <?php endif; ?>
                </center>
            </td>


            <td class="text-center">
                <center>
                    <?php if($s->s_status==1): ?>
                        فعال
                    <?php else: ?>
                        غیر فعال
                    <?php endif; ?>
                </center>
            </td>

            <td class="text-center">
                <a href="<?php echo e(Route('editSocialForm',$s->id)); ?>">
                    ویرایش
                </a>
            </td>

        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
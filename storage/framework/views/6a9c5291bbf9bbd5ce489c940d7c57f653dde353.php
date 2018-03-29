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
            نام کاربری
        </center>
    </td>
    <td class="text-right">
        <center>
            نام و نام خانوادگی
        </center>
    </td>
    <td class="text-right">
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
<?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td class="text-center">
            <input form="delForm" name="remove_val[]" value="<?php echo e($u->id); ?>" type="checkbox">
        </td>
        <td class="text-center">
            <center>
                <?php echo e($c); ?> <?php $c++; ?>
            </center>
        </td>
        <td class="text-center">
            <center>
                <?php echo e($u->user_name); ?>

            </center>
        </td>
        <td class="text-center">
            <center>
                <?php echo e($u->user_title); ?>

            </center>
        </td>
        <td class="text-center">
            <center>
                <?php if(trim($u->avatar_dir)!='' && file_exists( public_path().'/admin/uploads/users/'.$u->avatar_dir)): ?>
                    <img src="<?php echo e(url( '/admin/uploads/users/'.$u->avatar_dir)); ?>" class="shop-list-avatar">
                <?php else: ?>
                    <span>بدون تصویر</span>
                <?php endif; ?>
            </center>
        </td>
        <td class="text-center">
            <center>
                <?php if($u->user_status==1): ?>
                    فعال
                <?php else: ?>
                    غیر فعال
                <?php endif; ?>
            </center>
        </td>
        <td class="text-center">
            <a href="<?php echo e(url('management/user/admin/edit/'.$u->id)); ?>" data-toggle="tooltip" title="ویرایش کاربر">
                ویرایش کاربر
            </a></br>
            <a href="<?php echo e(url('management/user/admin/edit_sec_permit/'.$u->id)); ?>" data-toggle="tooltip" title="ویرایش دسترسی به بخشها">
                ویرایش دسترسیها
            </a>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content_list'); ?>
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-left">
            <center>
                کد مطلب
            </center>
        </td>
        <td class="text-left">
            <center>
عنوان مطلب
            </center>
        </td>
        <td class="text-right">
            <center>
                شهر
            </center>
        </td>
        <td class="text-right">
            <center>
                تعداد نظرات
            </center>
        </td>
        <td class="text-right">
            <center>
                امتیاز
            </center>
        </td>
        <td class="text-right">
            <center>
                بازدید
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
        <td class="text-right">
            <center>
                تاریخ انتشار
            </center>
        </td>
        <td class="text-right">
            <center>
                آخرین ویرایش
            </center>
        </td>

    </tr>

    </thead>
    <tbody>
    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="<?php echo e($content->id); ?>" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    <?php echo e($content->id); ?>

                </center>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e($content->content_title); ?></p>
                <?php if($content->content_status != 0): ?>
                    <a href="<?php echo e(Route('showArticle',$content->content_slug)); ?>" class="btn btn-bloglink" target="_blank">لینک مطلب</a>
                <?php endif; ?>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(($content->Cities()->first()!=Null)?$content->Cities()->first()->city_name:'-'); ?></p>
            </td>

            <td class="text-center">
                <p class="text"><?php echo e($content->RenterUserComments()->count()); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e($content->RenterUserScores()->count()); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e($content->view_count); ?></p>
            </td>

            <td class="text-center">
            <?php if($content->content_status != 1): ?>
                <p class="situation">تایید نشده</p>
            <?php else: ?>
                <p class="situation active">تایید شده</p>
            <?php endif; ?>
            </td>

            <td class="text-center">
                <a href="<?php echo e(route('adminEditContentForm',$content->id)); ?>" data-toggle="tooltip" title="ویرایش"><i class="fa fa-pencil"></i></a>
                <?php if($content->show_in_blog != 0): ?>
                    <a href="<?php echo e(route('adminShowinBlog',$content->id)); ?>" data-toggle="tooltip" title="نمایش در بالای بلاگ"><i class="fa fa-eye"></i></a>
                <?php else: ?>
                    <a href="<?php echo e(route('adminShowinBlog',$content->id)); ?>" data-toggle="tooltip" title="عدم نمایش در بالای بلاگ"><i class="fa fa-eye-slash"></i></a>
                <?php endif; ?>
            </td>

            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($content->created_at,true)); ?><br><?php echo e($content->created_at->format('H:i:s')); ?></p>
            </td>
            <td class="text-center">
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($content->updated_at,true)); ?><br><?php echo e($content->updated_at->format('H:i:s')); ?></p>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('paginationContainer'); ?>
    <?php echo e($contents->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
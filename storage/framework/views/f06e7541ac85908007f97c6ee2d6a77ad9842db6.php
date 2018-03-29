<?php $__env->startSection('tableBody'); ?>
<thead>
<tr>
    <th scope="col">کد مطلب</th>
    <th scope="col">عنوان مطلب</th>
    <th scope="col">شهر</th>
    <th scope="col">تعداد نظرات</th>
    <th scope="col">امتیاز تخصیص یافته</th>
    <th scope="col">تعداد بازدید</th>
    <th scope="col">وضعیت</th>
    <th scope="col">عملیات</th>
    <th scope="col">تاریخ انتشار</th>
    <th scope="col">آخرین ویرایش</th>
</tr>
</thead>
<tbody>
<?php if(count($contents)): ?>
    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th class="number" scope="row"><?php echo e($content->id); ?></th>
            <td>
                <p class="text"><?php echo e($content->content_title); ?></p>
                <?php if($content->content_status != 0): ?>
                    <a href="#" class="btn btn-bloglink">لینک مطلب</a>
                <?php endif; ?>
            </td>
            <td><p class="text"><?php echo e($content->Cities()->first()->city_name); ?></p></td>
            <td><p class="text"><?php echo e($content->RenterUserComments()->count()); ?></p></td>
            <td><p class="text"><?php echo e($content->RenterUserScores()->count()); ?></p></td>
            <td><p class="text"><?php echo e($content->view_count); ?></p></td>
            <td>
                <?php if($content->content_status != 1): ?>
                    <p class="situation">تایید نشده</p>
                <?php else: ?>
                    <p class="situation active">تایید شده</p>
                <?php endif; ?>
            </td>
            <td>
                <a href="<?php echo e(route('editcontent',$content->id)); ?>" data-toggle="tooltip" title="ویرایش"><i class="fa fa-pencil"></i></a>
                <?php if($content->show_in_body != 0): ?>
                    <a href="<?php echo e(route('showinbody',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="عدم نمایش در بالای بلاگ"><i class="fa fa-eye-slash"></i></a>
                <?php else: ?>
                    <a href="<?php echo e(route('showinbody',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="نمایش در بالای بلاگ"><i class="fa fa-eye"></i></a>
                <?php endif; ?>
                <br>
                <a href="#" data-toggle="tooltip" title="درخواست حذف"><i class="fa fa-trash"></i></a>
                <?php if($content->is_draft != 0): ?>
                    <a href="<?php echo e(route('draft',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="وضعیت:پیش نویس"><i class="fa fa-sticky-note"></i></a>
                <?php else: ?>
                    <a href="<?php echo e(route('draft',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="وضعیت:نهایی"><i class="fa fa-check"></i></a>
                <?php endif; ?>
            </td>
            <td>
                <p class="text"><?php echo e(Helpers::convert_date_g_to_j($content->created_at,true)); ?><br><?php echo e($content->created_at->format('H:i:s')); ?></p>
            </td>
            <td><p class="text"><?php echo e(Helpers::convert_date_g_to_j($content->updated_at,true)); ?><br><?php echo e($content->updated_at->format('H:i:s')); ?></p></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</tbody>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagination'); ?>
    <div class="pagination pull-left"><?php echo str_replace('/?', '?', $contents->render()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.masterLists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
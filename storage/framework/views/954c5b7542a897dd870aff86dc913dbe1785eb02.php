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
                </a>|
                <a href="<?php echo e(url(Route('adminEditVillaCategory',$v->id))); ?>" data-toggle="tooltip" title="ویرایش دسته بندیها">
                    دسته بندیها
                </a>|
                <a href="<?php echo e(url(Route('adminReportList',$v->id))); ?>" data-toggle="tooltip" title="گزارش تخلف">
                    گزارش تخلف
                </a>|
                <a href="<?php echo e(url(Route('adminVillaCommentList',$v->id))); ?>" data-toggle="tooltip" title="نظرات">
                    نظرات
                </a>
                |
                <a data-toggle="modal" data-target="#deleteAndTicketModal" onclick="$('#villa_id_to_deleteAndTicket').val('<?php echo e($v->id); ?>'); $('#deleteAndTicketVillaTitle').html('<?php echo e($v->villa_title); ?>'); " href="javascript:void" data-toggle="tooltip" title="حذف و ارسال تیکت برای کاربر">
                    حذف و ارسال پیام
                </a>

            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>


    <div id="deleteAndTicketModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">حذف ویلا و ارسال پیام برای کاربر</h4>
                </div>
                <div class="modal-body">
                    <h4>عنوان ویلا: <span id="deleteAndTicketVillaTitle"></span></h4>

                    <form id="deleteAndTicketFrm" method="POST" action="<?php echo e(Route('adminDoVillaDeleteAndTicket')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="villa_id_to_deleteAndTicket" id="villa_id_to_deleteAndTicket" value="" autocomplete="off" required>
                        <textarea rows="5" class="form-control" name="villaDeletionTicketMessage" placeholder="پیام خود را اینجا بنویسید"></textarea>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="submit" form="deleteAndTicketFrm" class="btn btn-danger">حذف ویلا و ارسال پیام</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                </div>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('paginationContainer'); ?>
    <?php echo e($villas->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master-lists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
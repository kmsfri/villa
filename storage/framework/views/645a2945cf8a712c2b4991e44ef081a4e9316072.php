<?php $__env->startSection('content_add_form'); ?>
<div class="main-panel">
    <?php $__currentLoopData = $masterCtgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="box-panel">
            <div class="header">
                <?php
                    $hasSubMenu=false;
                    if($mctg->SubCategory3()->count()>0)$hasSubMenu=true;
                ?>

                <input <?php echo e(($content->Categories3()->find($mctg->id)!=Null)?'checked':''); ?> class="checkbox" <?php echo e(($hasSubMenu)?'disabled':''); ?> type="checkbox" value="<?php echo e($mctg->id); ?>"  name="ctg[]" autocomplete="off"><?php echo e($mctg->category_title); ?><br><br>
                <?php if($hasSubMenu): ?> <a onclick="changeCheckBox('<?php echo e($mctg->id); ?>');" href="javascript:void()"  style="color:#d26b6b">نمایش زیر دسته های این دسته بندی</a><br> <?php endif; ?>
            </div>
            <?php if($hasSubMenu): ?>
                <div class="data" style="display: none;" id="checkCollection<?php echo e($mctg->id); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php $__currentLoopData = $mctg->SubCategory3EnabledOrdered()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input <?php echo e(($content->Categories3()->find($ctg->id)!=Null)?'checked':''); ?> type="checkbox" name="ctg[]" value="<?php echo e($ctg->id); ?>" autocomplete="off"> <?php echo e($ctg->category_title); ?>&nbsp;&nbsp;&nbsp;
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsCustom'); ?>
    <script type="text/javascript">
        function changeCheckBox(ctg_id){
            $('#checkCollection'+ctg_id).slideToggle();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('main'); ?>


    <div class="header-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                    <ul class="ul-header">
                        <!-- <li><a class="login" href="" title="محمد قلعه نوئی">محمد قلعه نوئی</a></li> -->
                        <li><a class="record" href="" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
        <li><a href="" title="پیشخوان">پیشخوان</a></li>
        <li><a href="" title="جاذبه های گردشگری">جاذبه های گردشگری</a></li>
        <li><a href="" title="ملک های من">افزودن جاذبه های گردشگری</a></li>
        <li><a href="" title="انتخاب دسته بندی">انتخاب دسته بندی</a></li>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="POST" action="<?php echo e(Route('doEditContentCategory')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="content_id" value="<?php echo e(old('content_id',isset($content->id) ? $content->id : '')); ?>" autocomplete="off">
                    <div class="box-panel padding">
                        <?php if( Session::has('data') ): ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo e(Session::get('data')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="header"><h3 class="title-box">انتخاب دسته بندی ها(انتخاب دسته بندی اجباری نیست)</h3><br></div>
                    </div>

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
                    <button class="btn btn-primary pull-left" type="submit">ذخیره</button>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('mapscript'); ?>
    <script type="text/javascript">
        function changeCheckBox(ctg_id){
            $('#checkCollection'+ctg_id).slideToggle();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.dashboard.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('main'); ?>
    <div class="header-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                    <ul class="ul-header">
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
                <div class="box-panel">
                    <div class="header">
                        <h3>اخطار</h3>
                    </div>

                    <div class="data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <h4><?php echo e($err_msg); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.dashboard.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
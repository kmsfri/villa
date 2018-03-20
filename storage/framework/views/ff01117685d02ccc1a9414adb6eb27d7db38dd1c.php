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
        <li><a href="" title="ملک های من">ویرایش اطلاعات کاربری</a></li>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="post" action="<?php echo e(route('useraction')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="box-panel padding">
                        <?php if( Session::has('data') ): ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo e(Session::get('data')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="header">
                            <h3 class="title-box">اطلاعات تکمیلی</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-small">
                                        <p>تصویر کاربر</p>
                                        <input type="file" name="image">
                                        <?php if($errors->has('image')): ?> <span class="help-block"><strong><?php echo e($errors->first('image')); ?></strong></span> <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>* نام و نام خانوادگی</label>
                                        <input class="form-control" type="text" value="<?php echo e(old('fullname',isset($user->fullname) ? $user->fullname : '')); ?>" name="fullname" required>
                                        <?php if($errors->has('fullname')): ?> <span class="help-block"><strong><?php echo e($errors->first('fullname')); ?></strong></span> <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>* موبایل</label>
                                        <input class="form-control" type="text" value="<?php echo e($user->mobile_number); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">آدرس های پروفایل</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>* آدرس</label>
                                        <input class="form-control" type="text" name="address" value="<?php echo e(old('address',isset($user->address) ? $user->address : '')); ?>" required>
                                        <?php if($errors->has('address')): ?> <span class="help-block"><strong><?php echo e($errors->first('address')); ?></strong></span> <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>* آدرس پروفایل شما(آدرس باید شامل عدد و حروف انگلیسی باشد- a-z 0-9)</label>
                                        <div class="input-group">
                                            <input class="form-control"  id="basic-url" aria-describedby="basic-addon3" style="direction: ltr" type="text" name="profile_slug" value="<?php echo e(old('profile_slug',isset($user->profile_slug) ? $user->profile_slug : '')); ?>" <?php if(isset($user->profile_slug)): ?> readonly <?php endif; ?> required>
                                            <span class="input-group-addon" id="basic-addon3">https://villayar.com/</span>
                                        </div>
                                        <?php if( Session::has('uniq') ): ?>
                                            <span class="help-block" style="color:red;font-size: 12px;"><?php echo e(Session::get('uniq')); ?></span><br>
                                        <?php endif; ?>
                                        <?php if(!isset($user->profile_slug)): ?>
                                             <span class="help-block">بعد از مشخص نمودن این مقدار، دیگر نمی توانید آن را تغییر دهید</span><br>
                                        <?php endif; ?>
                                        <?php if($errors->has('profile_slug')): ?> <span class="help-block"><strong><?php echo e($errors->first('profile_slug')); ?></strong></span> @endif
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">رمز عبور</h3><br>
                            <span class="help-block" style="color:red;font-size: 12px;">تنها در صورتی که رمز عبور خود را تغییر می دهید، مقادیر زیر را ویرایش کنید</span>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>* رمز عبور جدید</label>
                                        <input class="form-control" name="password" type="password" value="**||password-no-changed" required>


                                        <?php if($errors->has('password')): ?> <span class="help-block"><strong><?php echo e($errors->first('password')); ?></strong></span> <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>* تکرار رمز عبور جدید</label>
                                        <input class="form-control" name="repassword" type="password" value="**||password-no-changed" required>
                                        <?php if($errors->has('repassword')): ?> <span class="help-block"><strong><?php echo e($errors->first('repassword')); ?></strong></span> <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary pull-left" type="submit">ذخیره</button>
                </form>
            </div>
        </div>
    </div>






<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapscript'); ?>
    <script>
        $(document).ready(function(){
            var re = /^[a-zA-Z0-9]+$/;
            if (!$('#basic-url').is('[readonly]')) {
                if (re.test($("#basic-url").val())) {
                    $("#basic-url").css('border', '1px solid green');
                }
                else {
                    $("#basic-url").css('border', '1px solid red');
                }
            }
            $("#basic-url").keyup(function(){
                if (re.test($("#basic-url").val())) {
                    $("#basic-url").css('border','1px solid green');
                }
                else{
                    $("#basic-url").css('border','1px solid red');
                }

            });
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('user.dashboard.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
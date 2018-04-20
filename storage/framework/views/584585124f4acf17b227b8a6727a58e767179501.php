<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('user.web.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>
    <?php echo $__env->make('user.web.common.stickyheadsearch', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('user.web.common.responsivesearch', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(count($categories1)): ?>
    <a class="filter" href="" title="Filter"><img src="<?php echo e(asset('users/img/ic_filter_icon.png')); ?>" alt=""></a>
    <ul class="ul-rent">
        <?php $__currentLoopData = $categories1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="" title="<?php echo e($category1->category_title); ?>"><img src="" alt="<?php echo e($category1->category_title); ?>"><?php echo e($category1->category_title); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
    <!--start section search-->
    <?php echo $__env->make('user.web.common.centersearchbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--end section search-->

    <!--start section vila-->
    <?php echo $__env->make('user.web.common.villalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--end section vila-->

    <!--start section tourism-->
    <?php echo $__env->make('user.web.common.contents-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--end section tourism-->
    <!--section Follow up-->
    <section class="follow-up">
        <div class="container">
            <?php if(count($categories1)): ?>
            <div class="text-center">
                <h2 class="title-follow">دنبال چه ویلایی میگردی ؟</h2>
                <p class="description">امکان جستجو ویلا بر اساس نوع ویلا رو براتون فراهم کردیم</p>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    <div class="row">
                        <?php $__currentLoopData = $categories1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6 col-md-6 col-lg-4">
                            <div class="box-follow-up">
                                <figure><img src="<?php echo e(asset($category1->img1)); ?>" alt=""><img class="img" src="<?php echo e(asset($category1->img_hover)); ?>" alt="<?php echo e($category1->category_title); ?>"></figure>
                                <h3 class="title"><?php echo e($category1->category_title); ?></h3>
                                <div class="link"><a href="" title="نمایش ویلاها">نمایش ویلاها</a></div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="text-center">
                <h2 class="title-follow m-t-50">کاربران در مورد ما چه میگوید ؟</h2>
                <p class="description">بخشی از نظرات کاربران در مورد ویلایار</p>
            </div>
            <?php if($websitecomments): ?>
            <div class="slider-comment">
                <?php $__currentLoopData = $websitecomments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $websitecomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item"><img src="<?php echo e(asset('images/users/user-uploads/user-pics').'/'.$websitecomment->WritenBy()->first()->avatar_dir); ?>" alt=""/>
                    <p><?php echo e($websitecomment->comment_text); ?></p>
                    <p class="text-name"><?php echo e($websitecomment->WritenBy()->first()->fullname); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
            <div class="text-center"><a class="btn-comment" href="" data-toggle="modal" data-target="#commentmodal" title="ارسال نظرات">ارسال نظرات</a></div>
        </div>
    </section>
    <!--end section Follow up-->
    <!--start modal-->
    <script>
        $(document).ready(function(){
            $(document).on('click', 'span#close_first_modal', function(){
                $('#filterModal').modal('toggle');
            });
        });
    </script>
    <div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="commentmodallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo e(route('savewebsitecomment')); ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال نظر شما درباره وبسایت</h5>
                    <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                </div>
                <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <?php if(\Illuminate\Support\Facades\Auth::guard('user')->check()): ?>
                                    <?php echo e(csrf_field()); ?>

                                    <textarea name="websitecomment" rows="5" style="width: 100%" type="text" placeholder="نظر خود را وارد نمایید" required></textarea>
                                <?php else: ?>
                                <p>برای ثبت نظر باید وارد وبسایت شوید.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <?php if(\Illuminate\Support\Facades\Auth::guard('user')->check()): ?>
                    <button class="btn btn-primary" type="submit">ارسال</button>
                    <?php endif; ?>

                </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo $__env->make('user.web.common.filtermodal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if( Session::has('errorcomment') ): ?>
        <?php echo Session::get('errorcomment'); ?>


    <?php endif; ?>

    <?php $__env->startSection('jsmap'); ?>
        <script>
            function list_villa_rate(s_value,vid) {
                $.post("<?php echo e(route('rate_villa_list')); ?>",
                    {
                        s_value: s_value,
                        villa_id:vid
                    } ,
                    function(data){
                        if(data != "ok"){
                            alert('مشکلی در ثبت امتیاز به وجود آمده است، در صورت بروز مجدد، صفحه را دوباره رفرش کنید');
                        }

                    })
                    .fail(function() {
                        alert( "شما باید وارد حساب کاربری خود شوید" );
                        window.location = "<?php echo e(route('showlogin')); ?>";
                    })
            }
            function getCities(th,id)
            {

                selected_city = $('#'+id).attr('data-selected') || null;
                $('#'+id).html('').fadeIn(800).append('<option value="">لطفا کمی صبر کنید ...</option>');

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: '<?php echo e(url('ajax/get_province_cities')); ?>',
                    data: {r_id:$(th).val()},
                    dataType : 'text',
                    success: function(data)
                    {
                        var cities = $.parseJSON(data);

                        $('#'+id).html('').fadeIn(800).append('<option value="">انتخاب کنید</option>');
                        $.each(cities, function(i, city){
                            if(selected_city == city.id) $('#'+id).append('<option value="' + city.id + '" selected>' + city.city_name + '</option>');
                            else $('#'+id).append('<option value="' + city.id + '">' + city.city_name + '</option>');
                        });
                    },
                    error : function(data)
                    {
                        console.log('province_city.js#getCities function error: #line : 30');
                    }
                });


                return false;
            }

            $(document).on('change', '#state1', function (e) {
                getCities(this,"city1");
            });
            $(document).on('change', '#state2', function (e) {
                getCities(this,"city2");
            });
            $(document).on('change', '#state3', function (e) {
                getCities(this,"city3");
            });
            $(document).on('change', '#state4', function (e) {
                getCities(this,"city4");
            });
            $(document).on('change', '#state4', function (e) {
                getCities(this,"city4");
            });
            $(document).on('change', '#state5', function (e) {
                getCities(this,"city5");
            });
            $(document).on('change', '#city2', function (e) {
                getCities(this,"region2");
            });
            $(document).on('change', '#city4', function (e) {
                getCities(this,"region4");
            });
            $(document).on('change', '#city5', function (e) {
                getCities(this,"region5");
            });
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
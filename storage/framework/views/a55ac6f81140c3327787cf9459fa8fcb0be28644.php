<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('user.web.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>

    <section class="details">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="slider-single">
                        <?php $slides = $content->ContentImages()->get(); ?>
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item"><img src="<?php echo e(asset('images/users/user-uploads/user-contents').'/'.$slide->image_dir); ?>" alt=""></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="slider-small">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item"><img src="<?php echo e(asset('images/users/user-uploads/user-contents').'/'.$slide->image_dir); ?>" alt=""></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <article class="article-detail">
                        <div class="header">
                            <h1 class="title"><?php echo e($content->content_title); ?></h1>
                            <p class="author"><img src="<?php echo e(asset('images/users/user-uploads/user-pics').'/'.$content->authorRenterUser()->first()->avatar_dir); ?>" alt="<?php echo e($content->authorRenterUser()->first()->fullname); ?>"><?php echo e($content->authorRenterUser()->first()->fullname); ?></p>
                            <div class="clearfix"></div><?php $city = $content->Cities()->first(); ?>
                            <p class="place"><?php echo e(\App\Models\City::find($city->parent_id)->city_name); ?> - <?php echo e($city->city_name); ?></p>
                            <div class="my-rating-8"></div><span><?php \Carbon\Carbon::setLocale('fa'); ?> <?php echo e($content->created_at->diffForHumans()); ?></span>
                        </div>
                        <div class="data">
                            <?php echo $content->content_body; ?>

                        </div>
                    </article>
                    <div class="box-comment">
                        <div class="header">
                            <h3 class="title">ارسال نظرات<span>(<?php echo e($content->RenterUserComments()->where('comment_status','=',1)->count()); ?> نظر)</span></h3>
                        </div>
                        <div class="data">
                            <?php if(\Illuminate\Support\Facades\Auth::guard('user')->check()): ?>
                            <form method="POST" action="<?php echo e(route('content_comment',$content->id)); ?>">
                                <?php echo e(csrf_field()); ?>

                                <p>لطفا سوال یا تجربه خود از این منطقه گردشگری را در فرم زیر درج کنید</p>
                                <textarea class="form-control" rows="7" name="comment_text" required><?php echo e(old('comment_text')); ?></textarea>
                                <?php if($errors->has('comment_text')): ?> <span class="help-block"><strong><?php echo e($errors->first('comment_text')); ?></strong></span> <?php endif; ?>
                                <?php if( Session::has('data') ): ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <?php echo e(Session::get('data')); ?>

                                    </div>
                                <?php endif; ?>
                                <button class="btn btn-form" type="submit" placeholder="نظر شما :">ثبت نظر</button>
                            </form>
                            <?php else: ?>
                                <p>برای ثبت نظر باید وارد حساب کاربری خود شوید</p>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="comment-author">
                            <h3 class="title">نظرات کاربران<span>(<?php echo e($content->RenterUserComments()->where('comment_status','=',1)->count()); ?> نظر)</span></h3>
                            <?php $__currentLoopData = $content->RenterUserComments()->where('comment_status','=',1)->withPivot('comment_text')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="box-author">
                                <div class="row">
                                    <div class="col-md-1"><img src="<?php echo e(asset('images/users/user-uploads/user-pics').'/'.$cm->avatar_dir); ?>" width="50px"></div>
                                    <div class="col-md-11">
                                        <div class="data-author"><span class="title"><?php echo e($cm->fullname); ?></span><span class="time"><?php echo Helpers::returnexplodedtime($cm->pivot->created_at); ?> - ساعت: <?php echo e($cm->pivot->created_at->format('H:i:s')); ?></span>
                                            <p><?php echo e($cm->pivot->comment_text); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php if($content->longitude != null && $content->latitude != 0): ?>
                    <div class="box-comment">
                        <div class="header">
                            <h3 class="title">موقعیت مکانی اقامتگاه</h3>
                            <div id="map">
                                <div id="map-container"></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

<?php echo $__env->make('user.web.common.blogsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--end section details-->
                <!--start section villas-->
            <!--    <section class="villas">
                    <div class="container">
                        <div class="box-title">
                            <h2 class="title"><img src="content/img/icon/icon047.png" alt="">ویلا های مرتبط</h2><a class="more" href="" title="مشاهده بیشتر">مشاهده بیشتر</a>
                        </div>
                        <div class="slider-villas">
                            <div class="item">
                                <article class="vila">
                                    <figure><img src="content/img/article001.jpg" alt="ویلا استخردار در بابلسر"/><a class="estate" href="" title="مشاهده ملک">مشاهده ملک</a></figure>
                                    <div class="data">
                                        <h3 class="title"><a href="" title="ویلا استخردار در بابلسر">ویلا استخردار در بابلسر</a></h3><span class="price">260,000 تومان</span>
                                        <p class="place">مازندران - بابلسر</p>
                                        <div class="my-rating-8"></div><span class="number"><span>2</span></span>
                                    </div>
                                    <ul>
                                        <li><img src="content/img/icon/icon005.png" alt=""/><span>8 تخت خواب</span></li>
                                        <li><img src="content/img/icon/icon004.png" alt=""/><span>تا 6 مهمان</span></li>
                                        <li><img src="content/img/icon/icon006.png" alt=""/><span>3 اتاق خواب</span></li>
                                        <li><img src="content/img/icon/icon007.png" alt=""/><span>350 متر زیربنا</span></li>
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>
                </section>    -->
                <!--end section villas-->



<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsmap'); ?>
    <?php if($content->longitude != null && $content->latitude != 0): ?>
                    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&key=AIzaSyAUTOnItAcKwoEjTUA8nbIPjdOngcEpJV0"></script>
                    <script type="text/javascript">

                        function initMap() {
                            var myLatlng = new google.maps.LatLng(<?php echo e($content->latitude); ?>,<?php echo e($content->longitude); ?>);
                            var map = new google.maps.Map(document.getElementById('map-container'), {
                                center: myLatlng,
                                zoom: 6,
                                //disableDefaultUI: true,
                                zoomControl: true,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                scrollwheel: false,
                                animation: google.maps.Animation.DROP,
                            });
                            var marker = new google.maps.Marker({
                                position: myLatlng,
                                map: map,
                                icon: '<?php echo e(asset("users/img/marker-map.png")); ?>',
                                labelAnchor: new google.maps.Point(50, 0),
                                draggable: false
                            });
                            var infowindow = new google.maps.InfoWindow({
                                content:"<a href=\"google.ir\" style=\" padding-right: 15px; color: #000; font-size: 14px; font-weight: 500; font-family: Vazir; \"><?php echo e($content->content_title); ?></a>"
                            });

                            infowindow.open(map,marker);
                            google.maps.event.addListener(marker, "mouseup", function (event) {
                                infowindow.open(map,marker);
                            });


                        }



                        $( document ).ready(function() {
                            initMap();
                        });

                    </script>
    <?php endif; ?>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('user.web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
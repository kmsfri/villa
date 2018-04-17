<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('user.web.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>


    <?php echo $__env->make('user.web.common.stickyheadsearch', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--start section details-->
    <ul class="floating">
        <li><a href="" title=""><img src="<?php echo e(asset('users/img/floating-phone.png')); ?>"></a></li>
        <li><a href="" title=""><img src="<?php echo e(asset('users/img/floating-telegram.png')); ?>"></a></li>
    </ul><a class="owner subNavBtn" href="#box-price" title="تماس با مالک"><img src="<?php echo e(asset('users/img/owner.jpg')); ?>" alt="تماس با مالک"></a>
    <section class="details">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="slider-single">
                        <?php $slides = $villa->VillaImages()->get(); ?>
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item"><img src="<?php echo e(asset('').'/'.$slide->image_dir); ?>" alt=""></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="slider-small">
                        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item"><img src="<?php echo e(asset('').'/'.$slide->image_dir); ?>" alt=""></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <article class="article-detail">
                        <div class="header">
                            <h1 class="title"><?php echo e($villa->villa_title); ?></h1><span class="code">کد ملک :<span><?php echo e($villa->id); ?></span></span>
                            <div class="clearfix"></div><?php $city = $villa->Cities()->first(); ?>
                            <p class="place"><?php echo e(\App\Models\City::find($city->parent_id)->city_name); ?> - <?php echo e($city->city_name); ?></p>
                            <div class="my-rating-8"></div><span class="span"><?php \Carbon\Carbon::setLocale('fa'); ?> <?php echo e($villa->created_at->diffForHumans()); ?></span>
                        </div>
                        <div class="data">
                            <ul class="ul-article">
                                <li><img src="<?php echo e(asset('users/img/icon/icon088.png')); ?>" alt=""><span><?php echo e($villa->bed_count); ?> تخت خواب</span></li>
                                <li><img src="<?php echo e(asset('users/img/icon/icon087.png')); ?>" alt=""><span>تا <?php echo e($villa->max_capacity); ?> مهمان</span></li>
                                <li><img src="<?php echo e(asset('users/img/icon/icon086.png')); ?>" alt=""><span><?php echo e($villa->bedroom_count); ?> اتاق خواب</span></li>
                                <li><img src="<?php echo e(asset('users/img/icon/icon085.png')); ?>" alt=""><span><?php echo e($villa->foundation_area); ?> متر زیربنا</span></li>
                            </ul>
                        </div>
                    </article>
                    <div class="box-new">
                        <h3 class="title">مشخصات کلی</h3>
                        <div class="row">
                            <div class="col-lg-5 mr-auto">
                                <ul class="ul-new ul">
                                    <li><span>مساحت زمین :</span><span class="bold"><?php echo e($villa->land_area); ?> متر</span></li>
                                    <li><span>مساحت ساختمان</span><span class="bold"><?php echo e($villa->building_area); ?> متر</span></li>
                                    <li><span>تعداد طبقه :</span><span class="bold"><?php echo e($villa->floor_count); ?> طبقه</span></li>
                                    <li><span>تعداد اتاق خواب :</span><span class="bold"><?php echo e($villa->bedroom_count); ?> خواب</span></li>
                                    <li><span>تعداد تخت خواب :</span><span class="bold"><?php echo e($villa->bed_count); ?> تخت</span></li>
                                    <li><span>فاصله تا دریا ( ماشین ) :</span><span class="bold"><?php echo e($villa->sea_distance_by_car); ?> دقیقه</span></li>
                                    <li><span>فاصله تا دریا ( پیاده ) :</span><span class="bold"><?php echo e($villa->sea_distance_walking); ?> دقیقه</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <p class="text red">نرخ اجاره روزانه از<span>(هرشب)</span><span class="number"><?php echo e(number_format($villa->rent_daily_price_from)); ?> تومان</span></p>
                                <p class="text">روزهای وسط هفته<span>( شنبه تا چهارشنبه )</span><span class="number"><?php echo e(number_format($villa->midweek_price)); ?> تومان</span></p>
                                <p class="text">روزه های آخر هفته<span>( چهارشنبه تا جمعه )</span><span class="number"><?php echo e(number_format($villa->lastweek_price)); ?> تومان</span></p>
                                <p class="text">ایام پیک سال<span>( تعطیلات خاص )</span><span class="number"><?php echo e(number_format($villa->peaktime_price)); ?> تومان</span></p>
                                <p class="text-description"><?php echo e($villa->price_description); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="box-new">
                        <h3 class="title">درباره اقامتگاه</h3>
                        <div class="row">
                            <div class="col-md-11 mr-auto">
                                <div class="box-see">
                                    <?php echo e($villa->villa_description); ?>

                                </div><a class="link-see" href="" title="">+ مشاهده بیشتر . . .</a>
                            </div>
                        </div>
                    </div>

                    <div class="box-new">
                        <h3 class="title">ظرفیت</h3>
                        <div class="row">
                            <div class="col-md-11 mr-auto">
                                <ul class="ul-new width">
                                    <li><span> ظرفیت استاندارد :</span><span class="bold"><?php echo e($villa->standard_capacity); ?>  نفر</span></li>
                                    <li><span>تعداد حمام :</span><span class="bold"><?php echo e($villa->bathroom_count); ?> عدد</span></li>
                                    <li><span>متراژزیربنا :</span><span class="bold"><?php echo e($villa->foundation_area); ?> متر</span></li>
                                    <li><span>حداکثر ظرفیت :</span><span class="bold"><?php echo e($villa->max_capacity); ?> نفر</span></li>
                                    <li><span>تعداد دستشویی :</span><span class="bold"><?php echo e($villa->wc_count); ?> عدد</span></li>
                                    <li><span>متراژ محوطه :</span><span class="bold"><?php echo e($villa->court_area); ?> متر</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                        $ul_class_list=[
                        0=>'ul-new width',
                        2=>'new-ul',
                        3=>'ul-img',
                        4=>'',
                        ];
                    ?>
                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($property->parent_id == null): ?>
                    <div class="box-new">
                        <h3 class="title"> <?php echo e($property->prop_title); ?> </h3>
                        <div class="row">
                            <div class="col-md-11 mr-auto">
                                <?php if($property->show_type == 0): ?>
                                        <?php $desc=array(); $ps = $property->PropEnabledValues()->get(); ?>
                                        <ul class='<?php echo e($ul_class_list[$property->show_type]); ?>'>

                                            <?php $__currentLoopData = $villaprop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php $__currentLoopData = $ps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($prop->parent_id == $p->id && $prop->has_text_value != 1): ?>

                                                            <li><span><?php echo e($p->prop_title); ?> :</span><span class="bold"><?php echo e($prop->prop_title); ?></span>
                                                                
                                                            </li>
                                                            <?php
                                                                if($prop->pivot->description_text != null)
                                                                array_push($desc,$prop->pivot->description_text)
                                                            ?>

                                                        <?php elseif($prop->id == $p->id && $prop->has_text_value != 0): ?>
                                                            <li><span><?php echo e($p->prop_title); ?> :</span><span class="bold"><?php echo e($prop->pivot->text_value); ?></span>
                                                                
                                                            </li>
                                                            <?php
                                                                if($prop->pivot->description_text != null)
                                                                array_push($desc,$prop->pivot->description_text)
                                                            ?>
                                                        <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php if(count($desc)): ?>
                                        <div class="data-rules">
                                            <div class="row">
                                                <div class="col-md-11 mr-auto">
                                                    <p class="bold">توضیحات</p>
                                                    <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p><?php echo e($ds); ?></p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                <?php elseif($property->show_type == 2): ?>
                                    <?php $desc=array(); $ps = $property->PropEnabledValues()->get(); ?>

                                        <ul class='<?php echo e($ul_class_list[$property->show_type]); ?>'>
                                            <?php $__currentLoopData = $villaprop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php $__currentLoopData = $ps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if($prop->parent_id == $p->id): ?>

                                                        <li><img src="<?php echo e(asset($p->img_dir)); ?>" alt="">
                                                            <span class="bold"><?php echo e($p->prop_title); ?> :</span>
                                                            <span><?php echo e($prop->prop_title); ?></span>
                                                        </li>
                                                        <?php
                                                            if($prop->pivot->description_text != null)
                                                            array_push($desc,$prop->pivot->description_text)
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </ul>
                                    <?php if(count($desc)): ?>
                                        <div class="data-rules">
                                            <div class="row">
                                                <div class="col-md-11 mr-auto">
                                                    <p class="bold">توضیحات</p>
                                                    <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p><?php echo e($ds); ?></p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif($property->show_type == 3): ?>
                                    <?php $desc=array(); $ps = $property->PropEnabledValues()->get(); ?>
                                    <div class="box-see2">
                                    <ul class='<?php echo e($ul_class_list[$property->show_type]); ?>'>
                                        <?php $__currentLoopData = $villaprop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php $__currentLoopData = $ps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if($prop->id == $p->id): ?>
                                                    <li><img src="<?php echo e(asset($prop->img_dir)); ?>" alt=""><span><?php echo e($prop->prop_title); ?></span></li>
                                                    <?php
                                                        if($prop->pivot->description_text != null)
                                                        array_push($desc,$prop->pivot->description_text)
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    </div><a class="link-see2" href="" title="">+ مشاهده بیشتر . . .</a>
                                    <?php if(count($desc)): ?>
                                        <div class="data-rules">
                                            <div class="row">
                                                <div class="col-md-11 mr-auto">
                                                    <p class="bold">توضیحات</p>
                                                    <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p><?php echo e($ds); ?></p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif($property->show_type == 4): ?>
                                    <?php $desc=array(); $ps = $property->PropEnabledValues()->get(); ?>


                                        <?php $__currentLoopData = $villaprop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php $__currentLoopData = $ps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($prop->id == $p->id && $prop->has_text_value != 0): ?>
                                                    <p class="bold"><?php echo e($p->prop_title); ?> :</p>
                                                    <p><?php echo e($prop->pivot->text_value); ?></p>
                                                <hr>
                                                    <?php
                                                        if($prop->pivot->description_text != null)
                                                        array_push($desc,$prop->pivot->description_text)
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(count($desc)): ?>
                                        <div class="data-rules">
                                            <div class="row">
                                                <div class="col-md-11 mr-auto">
                                                    <p class="bold">توضیحات</p>
                                                    <?php $__currentLoopData = $desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <p><?php echo e($ds); ?></p>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                            <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                    <div class="box-new">
                        <div class="header">
                            <h3 class="title">امتیاز مهمانان<span>(1 نظر)</span></h3>
                        </div>
                        <div class="row">
                            <div class="col-md-11 mr-auto">
                                <ul class="ul-new width">
                                    <li><span>صحت مطالب :</span>
                                        <div class="my-rating-8"></div>
                                    </li>
                                    <li><span>پاکیزگی اقامتگاه :</span>
                                        <div class="my-rating-8"></div>
                                    </li>
                                    <li><span>تحویل به موقع :</span>
                                        <div class="my-rating-8"></div>
                                    </li>
                                    <li><span>شیوه برخورد میزبان :</span>
                                        <div class="my-rating-8"></div>
                                    </li>
                                    <li><span>مکان اقامتگاه  :</span>
                                        <div class="my-rating-8"></div>
                                    </li>
                                    <li><span>کیفیت نسبت به نرخ :</span>
                                        <div class="my-rating-8"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="box-comment">
                        <div class="header">
                            <h3 class="title">ارسال نظرات<span>(<?php echo e($villa->Comments()->where('comment_status','=',1)->count()); ?> نظر)</span></h3>
                        </div>
                        <div class="data">
                            <?php if(\Illuminate\Support\Facades\Auth::guard('user')->check()): ?>
                                <form method="POST" action="<?php echo e(route('villa_comment',$villa->id)); ?>">
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
                            <h3 class="title">نظرات کاربران<span>(<?php echo e($villa->Comments()->where('comment_status','=',1)->count()); ?> نظر)</span></h3>
                            <?php $__currentLoopData = $villa->Comments()->where('comment_status','=',1)->withPivot('comment_text')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                </div>
                <?php echo $__env->make('user.web.common.villasidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="map">
                        <div id="map-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end section details-->
    <!--start section villas-->
    <?php if(count($related_villas)): ?>
    <section class="villas color">
        <div class="container">
            <div class="box-title">
                <h2 class="title"><img src="<?php echo e(asset('users/img/icon/icon047.png')); ?>" alt="">ویلا های مرتبط</h2><a class="more" href="" title="مشاهده بیشتر">مشاهده بیشتر</a>
            </div>
            <div class="slider-villas">
                <?php $__currentLoopData = $related_villas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_villa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <article class="vila">
                        <figure><img src="<?php echo e(asset($related_villa->VillaImages()->orderBy('image_order','ASC')->first()->image_dir)); ?>" alt="<?php echo e($related_villa->villa_title); ?>"/><a class="estate" href="" title="<?php echo e($related_villa->villa_title); ?>">مشاهده ملک</a><a class="heart" href=""><i class="fa fa-heart-o"></i></a></figure>
                        <div class="data">
                            <h3 class="title"><a href="" title="<?php echo e($related_villa->villa_title); ?>"><?php echo e($related_villa->id); ?></a></h3><span class="price"><?php echo e(number_format($related_villa->rent_daily_price_from)); ?> تومان</span>
                            <?php $city = $villa->Cities()->first(); ?>
                            <p class="place"><?php echo e(\App\Models\City::find($city->parent_id)->city_name); ?> - <?php echo e($city->city_name); ?></p>
                            <div class="my-rating-8"></div><span class="number"><span><?php echo e($related_villa->Comments()->where('comment_status','=',1)->count()); ?></span></span>
                        </div>
                        <ul>
                            <li><img src="<?php echo e(asset('users/img/icon/icon088.png')); ?>" alt=""><span><?php echo e($related_villa->bed_count); ?> تخت خواب</span></li>
                            <li><img src="<?php echo e(asset('users/img/icon/icon087.png')); ?>" alt=""><span>تا <?php echo e($related_villa->max_capacity); ?> مهمان</span></li>
                            <li><img src="<?php echo e(asset('users/img/icon/icon086.png')); ?>" alt=""><span><?php echo e($related_villa->bedroom_count); ?> اتاق خواب</span></li>
                            <li><img src="<?php echo e(asset('users/img/icon/icon085.png')); ?>" alt=""><span><?php echo e($related_villa->foundation_area); ?> متر زیربنا</span></li>
                        </ul>
                    </article>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!--end section villas-->
    <!--start section tourism-->
    <?php echo $__env->make('user.web.common.contents-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--end section tourism-->







<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsmap'); ?>
    <?php if($villa->longitude != null && $villa->latitude != 0): ?>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&key=AIzaSyAUTOnItAcKwoEjTUA8nbIPjdOngcEpJV0"></script>
        <script type="text/javascript">

            function initMap() {
                var myLatlng = new google.maps.LatLng(<?php echo e($villa->latitude); ?>,<?php echo e($villa->longitude); ?>);
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
                    content:"<a href=\"google.ir\" style=\" padding-right: 15px; color: #000; font-size: 14px; font-weight: 500; font-family: Vazir; \"><?php echo e($villa->villa_title); ?></a>"
                });

                infowindow.open(map,marker);
                google.maps.event.addListener(marker, "mouseup", function (event) {
                    infowindow.open(map,marker);
                });


            }



            $( document ).ready(function() {
                initMap();
            });

            function getCities(th,id)
            {

                selected_city = $('#'+id).attr('data-selected') || null;
                $('#'+id).html('').fadeIn(800).append('<option value="0">لطفا کمی صبر کنید ...</option>');

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: '<?php echo e(url('ajax/get_province_cities')); ?>',
                    data: {r_id:$(th).val()},
                    dataType : 'text',
                    success: function(data)
                    {
                        var cities = $.parseJSON(data);

                        $('#'+id).html('').fadeIn(800).append('<option value="0">انتخاب کنید</option>');
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
        </script>
        <script>
            jQuery(document).ready(function(){

                (function(a){a.extend({persianNumbers:function(b){var g={0:"۰",1:"۱",2:"۲",3:"۳",4:"۴",5:"۵",6:"۶",7:"۷",8:"۸",9:"۹"};var d=(b+"").split("");var f=d.length;var c;for(var e=0;e<=f;e++){c=d[e];if(g[c]){d[e]=g[c]}}return d.join("")}})})(jQuery);
                jQuery(document).on('click', '[data-enevtsum]', function(){
                    var typesum = jQuery(this).data('enevtsum');
                    var thisvalue = jQuery("input[name=price]").val();
                    var repl = parseInt(jQuery("input[name=price_to_search]").val());

                    let mo = 100000;
                    if(typesum ==="sub") {
                        var newprice = parseInt(repl) - mo;
                    } else {
                        var newprice = parseInt(repl) + mo;
                    }

                    jQuery("input[name=price_to_search]").val(newprice);
                    var parts = newprice.toString().split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    var new_price =  jQuery.persianNumbers(parts.join(".")) + " تومان";

                    jQuery("input[name=price]").val(new_price);
                });




            });

            $(".datepicker").datepicker({
                changeMonth: true, // True if month can be selected directly, false if only prev/next
                changeYear: true,
                yearRange: 'c-0:c+2',
            });


        </script>
        <?php echo session('errorcomment'); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.web.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
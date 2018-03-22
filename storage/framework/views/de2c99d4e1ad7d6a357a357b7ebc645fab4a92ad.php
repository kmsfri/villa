<?php $__env->startSection('content_add_form'); ?>
<div class="main-panel">
    <div class="box-panel padding">
        <div class="header">
            <h3 class="title-box">جزئیات برگه</h3><br>
        </div>
        <div class="data">
            <div class="row">
                <div class="col-md-6">
                    <div class="box-form">
                        <input id="files" type="file" name="newImg[]" multiple="multiple" autocomplete="off" accept="image/jpg, image/jpeg, image/png" /><br>
                        <output id="result">
                            <?php if(isset($content) && $content!=Null): ?>
                                <?php $__currentLoopData = $content->ContentImages()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cimg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <img class="thumbnail" src="<?php echo e(url('images/users/user-uploads/user-contents/'.$cimg->image_dir)); ?>">
                                        <input name="oldImg[]" type="hidden" value="<?php echo e($cimg->id); ?>">
                                        <a href="javascript:void()" onclick="$(this).closest('div').remove()" style="display: block">حذف</a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </output>
                        <?php if($errors->has('newImg.*')): ?> <span class="help-block"><strong><?php echo e($errors->first('newImg.*')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>* عنوان مطلب</label>
                        <input class="form-control" type="text" value="<?php echo e(old('content_title',isset($content->content_title) ? $content->content_title : '')); ?>" name="content_title" required>
                        <?php if($errors->has('content_title')): ?> <span class="help-block"><strong><?php echo e($errors->first('content_title')); ?></strong></span> <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>* آدرس مطلب(url)</label>
                        <input class="form-control" type="text" value="<?php echo e(old('content_slug',isset($content->content_slug) ? $content->content_slug : '')); ?>" name="content_slug" required>
                        <?php if($errors->has('content_slug')): ?> <span class="help-block"><strong><?php echo e($errors->first('content_slug')); ?></strong></span> <?php endif; ?>
                    </div>
                    <div class="form-group arrow">
                        <label>استان</label>
                        <select class="form-control" id="state" name="state" required autocomplete="off">
                            <option <?php echo e((!old('state', isset($content->province) ? $content->province : '')? 'selected' : '')); ?> value="" >انتخاب استان</option>
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(old('state', isset($content->province) ? $content->province : '')==$pr->id): ?> selected <?php endif; ?> value="<?php echo e($pr->id); ?>" ><?php echo e($pr->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('state')): ?> <span class="help-block"><strong><?php echo e($errors->first('state')); ?></strong></span> <?php endif; ?>
                    </div>
                    <div class="form-group arrow">
                        <label>شهر</label>
                        <select class="form-control" id="city" name="city" required autocomplete="off">
                            <option <?php echo e((!old('city', isset($content->city_id) ? $content->city_id : '')? 'selected' : '')); ?> value="" disabled>شهر را انتخاب کنید</option>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(old('city', isset($content->city_id) ? $content->city_id : '')==$city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>" ><?php echo e($city->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('city')): ?> <span class="help-block"><strong><?php echo e($errors->first('city')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-panel">
        <div class="header">
            <h3 class="title-box">متن مطلب</h3><br>
        </div>
        <div class="data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" id="cktext" rows="6" name="content_body" required><?php echo e(old('content_body',isset($content->content_body) ? $content->content_body : '')); ?></textarea>
                        <?php if($errors->has('content_body')): ?> <span class="help-block"><strong><?php echo e($errors->first('content_body')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-panel">
        <div class="header">
            <h3 class="title-box">تنظیمات مطلب</h3><br>
        </div>
        <div class="data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>* برچسب ها(کلمات کلیدی را با ویرگول جدا نمایید)</label>
                        <input class="form-control" value="<?php echo e(old('content_tags',isset($content->content_tags) ? $content->content_tags : '')); ?>" type="text" name="content_tags" required>
                        <?php if($errors->has('content_tags')): ?> <span class="help-block"><strong><?php echo e($errors->first('content_tags')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>اولویت مطلب</label>
                        <select class="form-control" name="content_order" required autocomplete="off">
                            <?php for($i = 1;$i <= 20; $i++): ?>
                                <option <?php if(old('content_order', isset($content->content_order) ? $content->content_order : '')==$i): ?> selected <?php endif; ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php if($errors->has('content_order')): ?> <span class="help-block"><strong><?php echo e($errors->first('content_order')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>حالت ذخیره</label>
                        <select class="form-control" name="is_draft" required autocomplete="off">
                            <option <?php if(old('is_draft', isset($content->is_draft) ? $content->is_draft : '')==0): ?> selected <?php endif; ?> value="0">نهایی</option>
                            <option <?php if(old('is_draft', isset($content->is_draft) ? $content->is_draft : '')==1): ?> selected <?php endif; ?> value="1">پیش نویس</option>
                        </select>
                        <?php if($errors->has('is_draft')): ?> <span class="help-block"><strong><?php echo e($errors->first('is_draft')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>وضعیت</label>
                        <select class="form-control" name="content_status" required autocomplete="off">
                            <option <?php if(old('content_status', isset($content->content_status) ? $content->content_status : '')==0): ?> selected <?php endif; ?> value="0">تایید نشده</option>
                            <option <?php if(old('content_status', isset($content->content_status) ? $content->content_status : '')==1): ?> selected <?php endif; ?> value="1">تایید شده</option>
                        </select>
                        <?php if($errors->has('content_status')): ?> <span class="help-block"><strong><?php echo e($errors->first('content_status')); ?></strong></span> <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-panel">
        <div class="header">
            <h3 class="title-box">موقعیت مکانی اقامتگاه</h3>
        </div>
        <div class="data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>آدرس محل اقامتگاه</label>
                    </div>
                    <input type="hidden" value="" id="latitude" name="latitude">
                    <input type="hidden" value="" id="longitude" name="longitude">
                    <div id="map">
                        <div id="map-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsCustom'); ?>
    <script src="<?php echo e(asset('users/ckeditor/ckeditor.js')); ?>"></script>
    <script>
        CKEDITOR.replace('cktext');
    </script>
    <script type="text/javascript">
        window.onload = function(){

            //Check File API support
            if(window.File && window.FileList && window.FileReader)
            {
                var filesInput = document.getElementById("files");

                filesInput.addEventListener("change", function(event){



                    var files = event.target.files; //FileList object

                    var output = document.getElementById("result");
                    $( ".newImgThumb" ).remove();
                    for(var i = 0; i< files.length; i++)
                    {
                        var file = files[i];


                        //Only pics
                        if(!file.type.match('image'))
                            continue;

                        var picReader = new FileReader();


                        picReader.addEventListener("load",function(event){

                            var picFile = event.target;
                            var div = document.createElement("div");


                            div.innerHTML = "" +
                                "<img class='thumbnail newImgThumb' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>" +
                                "<span class='newImgThumb' style=\"display: block\">تصویر جدید</span>"
                            ;
                            $(output).append(div);

                        });

                        //Read the image
                        picReader.readAsDataURL(file);
                    }

                });
            }
            else
            {
                console.log("Your browser does not support File API");
            }
        }
    </script>
    <script>
        function getCities(th)
        {

            selected_city = $('#city').attr('data-selected') || null;
            $('#city').html('').fadeIn(800).append('<option value="0">لطفا کمی صبر کنید ...</option>');

            $.ajax({
                type: "POST",
                cache: false,
                url: '<?php echo e(url('ajax/get_province_cities')); ?>',
                data: {r_id:$(th).val()},
                dataType : 'text',
                success: function(data)
                {
                    var cities = $.parseJSON(data);

                    $('#city').html('').fadeIn(800).append('<option value="0">انتخاب شهر</option>');
                    $.each(cities, function(i, city){
                        if(selected_city == city.id) $('#city').append('<option value="' + city.id + '" selected>' + city.city_name + '</option>');
                        else $('#city').append('<option value="' + city.id + '">' + city.city_name + '</option>');
                    });
                },
                error : function(data)
                {
                    console.log('province_city.js#getCities function error: #line : 30');
                }
            });


            return false;
        }

        $(document).on('change', '#state', function (e) {
            getCities(this);
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&key=AIzaSyAUTOnItAcKwoEjTUA8nbIPjdOngcEpJV0"></script>
    <script type="text/javascript">

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map-container'), {
                center: {lat: 35.42323874580487, lng: 52.07075264355467 },
                zoom: 6,
                //disableDefaultUI: true,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                animation: google.maps.Animation.DROP,
            });
            var marker = new google.maps.Marker({
                position: {lat: <?php echo e((isset($content->latitude) && ($content->latitude!=Null && trim($content->latitude)!=''))?$content->latitude:'35.42323874580487'); ?>, lng: <?php echo e((isset($content->latitude) && ($content->longitude!=Null && trim($content->longitude)!=''))?$content->longitude:'52.07075264355467'); ?> },
                map: map,
                icon: '<?php echo e(asset("users/img/marker-map.png")); ?>',
                labelAnchor: new google.maps.Point(50, 0),
                draggable: true
            });
            google.maps.event.addListener(marker, "mouseup", function (event) {
                var latitude = this.position.lat();
                var longitude = this.position.lng();
                $('#latitude').val( this.position.lat() );
                $('#longitude').val( this.position.lng() );
            });


        }



        $( document ).ready(function() {
            initMap();
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master-add', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
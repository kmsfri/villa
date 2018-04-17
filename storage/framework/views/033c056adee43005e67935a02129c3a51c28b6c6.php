<?php $__env->startSection('content_add_form'); ?>
    <?php if(session('cities')): ?>
        <?php
            $cities=session('cities');
        ?>
    <?php endif; ?>
    <?php if(session('districts')): ?>
        <?php
            $districts=session('districts');
        ?>
    <?php endif; ?>
    <input type="hidden" name="renter_user_id" value="<?php echo e(old('renter_user_id',isset($renter_user_id) ? $renter_user_id : '')); ?>">
    <div class="main-panel">
        <div class="box-panel padding">
            <div class="data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-form">
                            <input id="files" type="file" name="newImg[]" multiple="multiple" autocomplete="off" accept="image/jpg, image/jpeg, image/png" /><br>
                            <output id="result">
                                <?php if(isset($villa) && $villa!=Null): ?>
                                    <?php $__currentLoopData = $villa->VillaImages()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cimg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div>
                                            <img class="thumbnail" src="<?php echo e(url($cimg->image_dir)); ?>">
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
                            <label>* عنوان آگهی ویلا</label>
                            <input class="form-control" type="text" value="<?php echo e(old('villa_title',isset($villa->villa_title) ? $villa->villa_title : '')); ?>" name="villa_title" required>
                            <?php if($errors->has('villa_title')): ?> <span class="help-block"><strong><?php echo e($errors->first('villa_title')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group arrow">
                            <label>استان</label>
                            <select class="form-control" id="state" name="state" required autocomplete="off">
                                <option <?php echo e((!old('state', isset($villa->province) ? $villa->province : '')? 'selected' : '')); ?> value="" >انتخاب استان</option>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('state', isset($villa->province) ? $villa->province : '')==$pr->id): ?> selected <?php endif; ?> value="<?php echo e($pr->id); ?>" ><?php echo e($pr->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('state')): ?> <span class="help-block"><strong><?php echo e($errors->first('state')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group arrow">
                            <label>شهر</label>
                            <select class="form-control" id="city" name="city" required autocomplete="off">
                                <option <?php echo e((!old('city', isset($villa->city_id) ? \App\Models\City::find($villa->city_id)->province()->first()->id : '')? 'selected' : '')); ?> value="" disabled>شهر را انتخاب کنید</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('city', isset($villa->city_id) ? $villa->city_id : '')==$city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>" ><?php echo e($city->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('city')): ?> <span class="help-block"><strong><?php echo e($errors->first('city')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group arrow">
                            <label>منطقه</label>
                            <select class="form-control" id="district" name="district" required autocomplete="off">
                                <option <?php echo e((!old('district', isset($villa->district) ? $villa->district : '')? 'selected' : '')); ?> value="" disabled>منطقه را انتخاب کنید</option>
                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('district', isset($villa->district) ? $villa->district : '')==$dst->id): ?> selected <?php endif; ?> value="<?php echo e($dst->id); ?>" ><?php echo e($dst->city_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('district')): ?> <span class="help-block"><strong><?php echo e($errors->first('district')); ?></strong></span> <?php endif; ?>
                        </div>


                        <div class="form-group arrow">
                            <label>نوع ملک/ویلا</label>
                            <select class="form-control" id="villa_type_id" name="villa_type_id" required autocomplete="off">
                                <option <?php echo e((!old('villa_type_id', isset($villa->villa_type_id) ? $villa->villa_type_id : '')? 'selected' : '')); ?> value="" >انتخاب نوع ملک/ویلا</option>
                                <?php $__currentLoopData = $villaTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $VT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(old('villa_type_id', isset($villa->villa_type_id) ? $villa->villa_type_id : '')==$VT->id): ?> selected <?php endif; ?> value="<?php echo e($VT->id); ?>" ><?php echo e($VT->villa_type_title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('villa_type_id')): ?> <span class="help-block"><strong><?php echo e($errors->first('villa_type_id')); ?></strong></span> <?php endif; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>




        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">مشخصات کلی</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>* مساحت زمین</label>
                            <input name="land_area" placeholder="متر مربع" value="<?php echo e(old('land_area',isset($villa->land_area) ? $villa->land_area : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('land_area')): ?> <span class="help-block"><strong><?php echo e($errors->first('land_area')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>* مساحت ساختمان</label>
                            <input name="building_area" placeholder="متر مربع" value="<?php echo e(old('building_area',isset($villa->building_area) ? $villa->building_area : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('building_area')): ?> <span class="help-block"><strong><?php echo e($errors->first('building_area')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>زیربنا</label>
                            <input name="foundation_area" placeholder="متر مربع" value="<?php echo e(old('foundation_area',isset($villa->foundation_area) ? $villa->foundation_area : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('foundation_area')): ?> <span class="help-block"><strong><?php echo e($errors->first('foundation_area')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group arrow">
                            <label>تعداد طبقه</label>
                            <select class="form-control" name="floor_count" required autocomplete="off">
                                <option selected="" <?php echo e((old('floor_count', isset($villa->floor_count) ? $villa->floor_count : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 10; $i++): ?>
                                    <option <?php echo e((old('floor_count', isset($villa->floor_count) ? $villa->floor_count : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('floor_count')): ?> <span class="help-block"><strong><?php echo e($errors->first('floor_count')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group arrow">
                            <label>تعداد اتاق خواب</label>
                            <select class="form-control" name="bedroom_count" required autocomplete="off">
                                <option selected="" <?php echo e((old('bedroom_count', isset($villa->bedroom_count) ? $villa->bedroom_count : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 10; $i++): ?>
                                    <option <?php echo e((old('bedroom_count', isset($villa->bedroom_count) ? $villa->bedroom_count : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('bedroom_count')): ?> <span class="help-block"><strong><?php echo e($errors->first('bedroom_count')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group arrow">
                            <label>تعداد تخت خواب</label>
                            <select class="form-control" name="bed_count" required autocomplete="off">
                                <option selected="" <?php echo e((old('bed_count', isset($villa->bed_count) ? $villa->bed_count : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 10; $i++): ?>
                                    <option <?php echo e((old('bed_count', isset($villa->bed_count) ? $villa->bed_count : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('bed_count')): ?> <span class="help-block"><strong><?php echo e($errors->first('bed_count')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>فاصله تا دریا ( ماشین )</label>
                            <input name="sea_distance_by_car" placeholder="ساعت / دقیقه" value="<?php echo e(old('sea_distance_by_car',isset($villa->sea_distance_by_car) ? $villa->sea_distance_by_car : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('sea_distance_by_car')): ?> <span class="help-block"><strong><?php echo e($errors->first('sea_distance_by_car')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>فاصله تا دریا ( پیاده )</label>
                            <input name="sea_distance_walking" placeholder="ساعت / دقیقه" value="<?php echo e(old('sea_distance_walking',isset($villa->sea_distance_walking) ? $villa->sea_distance_walking : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('sea_distance_walking')): ?> <span class="help-block"><strong><?php echo e($errors->first('sea_distance_walking')); ?></strong></span> <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>نرخ اجاره روزانه</label>
                            <input name="rent_daily_price_from" placeholder="مبلغ به تومان" value="<?php echo e(old('rent_daily_price_from',isset($villa->rent_daily_price_from) ? $villa->rent_daily_price_from : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('rent_daily_price_from')): ?> <span class="help-block"><strong><?php echo e($errors->first('rent_daily_price_from')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>نرخ اجاره روزانه روزهای وسط هفته ( شنبه تا چهارشنبه )</label>
                            <input name="midweek_price" placeholder="مبلغ به تومان" value="<?php echo e(old('midweek_price',isset($villa->midweek_price) ? $villa->midweek_price : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('midweek_price')): ?> <span class="help-block"><strong><?php echo e($errors->first('midweek_price')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>نرخ اجاره روزانه روزهای آخر هفته (  چهارشنبه تا جمعه )</label>
                            <input name="lastweek_price" placeholder="مبلغ به تومان" value="<?php echo e(old('lastweek_price',isset($villa->lastweek_price) ? $villa->lastweek_price : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('lastweek_price')): ?> <span class="help-block"><strong><?php echo e($errors->first('lastweek_price')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>نرخ اجاره روزانه ایام پیک سال</label>
                            <input name="peaktime_price" placeholder="مبلغ به تومان" value="<?php echo e(old('peaktime_price',isset($villa->peaktime_price) ? $villa->peaktime_price : '')); ?>" class="form-control" type="text">
                            <?php if($errors->has('peaktime_price')): ?> <span class="help-block"><strong><?php echo e($errors->first('peaktime_price')); ?></strong></span> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>توضیحات اجاره</label>
                            <textarea rows="9" class="form-control" name="price_description" placeholder="قیمت اعلام شده مربوط به روزهای عادی و تا سقف ظرفیت نرمال میباشد و قیمت در روز های آخر هفته، تعطیلات، مناسبت ها، ایام نوروز و یا نفرات بیش از ظرفیت نرمال، افزایش می یابد."><?php echo e(old('price_description',isset($villa->price_description) ? Helpers::br2nl($villa->price_description) : '')); ?></textarea>
                            <?php if($errors->has('price_description')): ?><span class="help-block"><strong><?php echo e($errors->first('price_description')); ?></strong></span><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">ظرفیت</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>ظرفیت نرمال</label>


                            <select class="form-control" name="standard_capacity" required autocomplete="off">
                                <option selected="" <?php echo e((old('standard_capacity', isset($villa->standard_capacity) ? $villa->standard_capacity : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 20; $i++): ?>
                                    <option <?php echo e((old('standard_capacity', isset($villa->standard_capacity) ? $villa->standard_capacity : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('standard_capacity')): ?> <span class="help-block"><strong><?php echo e($errors->first('standard_capacity')); ?></strong></span> <?php endif; ?>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>تعداد حمام</label>
                            <select class="form-control" name="bathroom_count" required autocomplete="off">
                                <option selected="" <?php echo e((old('bathroom_count', isset($villa->bathroom_count) ? $villa->bathroom_count : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 5; $i++): ?>
                                    <option <?php echo e((old('bathroom_count', isset($villa->bathroom_count) ? $villa->bathroom_count : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('bathroom_count')): ?> <span class="help-block"><strong><?php echo e($errors->first('bathroom_count')); ?></strong></span> <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>حداکثر ظرفیت</label>


                            <select class="form-control" name="max_capacity" required autocomplete="off">
                                <option selected="" <?php echo e((old('max_capacity', isset($villa->max_capacity) ? $villa->max_capacity : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 5; $i++): ?>
                                    <option <?php echo e((old('max_capacity', isset($villa->max_capacity) ? $villa->max_capacity : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('max_capacity')): ?> <span class="help-block"><strong><?php echo e($errors->first('max_capacity')); ?></strong></span> <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>تعداد دستشویی</label>
                            <select class="form-control" name="wc_count" required autocomplete="off">
                                <option selected="" <?php echo e((old('wc_count', isset($villa->wc_count) ? $villa->wc_count : '')=='')?'selected':''); ?>> انتخاب کنید</option>
                                <?php for($i = 1;$i <= 5; $i++): ?>
                                    <option <?php echo e((old('wc_count', isset($villa->wc_count) ? $villa->wc_count : '')==$i)?'selected':''); ?> value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if($errors->has('wc_count')): ?> <span class="help-block"><strong><?php echo e($errors->first('wc_count')); ?></strong></span> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="box-panel">
                <div class="header">
                    <h3 class="title-box"><?php echo e($pr->prop_title); ?></h3>
                </div>
                <?php if($pr->PropEnabledValues()->where('has_text_value',1)->count()>0): ?>
                    <?php
                        $class1='box-p';
                    ?>
                <?php else: ?>
                    <?php
                        $class1='data';
                    ?>
                <?php endif; ?>
                <div class="<?php echo e($class1); ?>">

                        <?php $counter1=1; $colorClassFlag=true; ?>
                        <?php $__currentLoopData = $pr->PropEnabledValues()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propValue1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($propValue1->has_text_value==1): ?>

                            <?php if($counter1==1): ?>
                            <div class="row <?php echo e(($colorClassFlag)?'color':''); ?> padding">
                                <?php if($colorClassFlag): ?> <?php $colorClassFlag=false; ?> <?php else: ?> <?php $colorClassFlag=true ?> <?php endif; ?>
                            <?php endif; ?>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="list__item">
                                                <label class="label--checkbox">
                                                    <input name="propCheck[<?php echo e($propValue1->id); ?>]" <?php echo e((isset($villa)&&$villa->Properties()->where('property_id',$propValue1->id)->count()>0)?'checked':''); ?> value="<?php echo e($propValue1->id); ?>" class="checkbox" type="checkbox"><?php echo e($propValue1->prop_title); ?>

                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-8">
                                            <input name="propText[<?php echo e($propValue1->id); ?>]" class="form-control" type="text" value="<?php echo e((isset($villa)&&($VP=$villa->Properties()->withPivot(['text_value'])->where('property_id',$propValue1->id))->count()>0)?$VP->first()->pivot->text_value:''); ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php if($counter1==2 || $pr->PropEnabledValues()->get()->last()->id==$propValue1->id): ?>
                            </div>
                            <?php endif; ?>
                            <?php if($counter1>=2): ?>
                                <?php $counter1=1; ?>
                            <?php else: ?>
                                <?php $counter1+=1; ?>
                            <?php endif; ?>



                            <?php else: ?>
                                <?php if(isset($villa)): ?>
                                <?php $__currentLoopData = $villa->AllSpecProperty($propValue1->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneSP): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6">
                                    <div class="form-group arrow">
                                        <label><?php echo e($propValue1->prop_title); ?></label>
                                        <?php if($propValue1->guide_text!=Null && $propValue1->guide_text!=''): ?>
                                        <button class="btn btn-group2" type="button" data-toggle="tooltip" data-placement="top" title="<?php echo e($propValue1->guide_text); ?>">؟</button>
                                        <?php endif; ?>

                                        <select  name='props[]' class='selectpicker form-control pull-right' autocomplete="off">
                                            <option  value="" >انتخاب کنید</option>
                                            <?php $__currentLoopData = $propValue1->PropEnabledValues()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('props.'.$propValue1->id , (isset($villa)&&isset($oneSP->id)) ? $oneSP->id : '')==$prv->id): ?> selected <?php endif; ?> value="<?php echo e($prv->id); ?>" ><?php echo e($prv->prop_title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if((isset($villa) && $villa->AllSpecProperty($propValue1->id)->count()>0 && $propValue1->multi_assign==1) || (!isset($villa) || (isset($villa)&&$villa->AllSpecProperty($propValue1->id)->count()==0))): ?>
                                <div id="selectContainer<?php echo e($propValue1->id); ?>">
                                    <div id="selectInstance<?php echo e($propValue1->id); ?>">
                                        <div class="selectInstanceCol col-md-6">
                                            <div class="form-group arrow">
                                                <label><?php echo e($propValue1->prop_title); ?></label>
                                                <?php if($propValue1->guide_text!=Null && $propValue1->guide_text!=''): ?>
                                                    <button class="btn btn-group2" type="button" data-toggle="tooltip" data-placement="top" title="<?php echo e($propValue1->guide_text); ?>">؟</button>
                                                <?php endif; ?>
                                                <select  name='props[]' class='selectpicker form-control pull-right' autocomplete="off">
                                                    <option  value="" >انتخاب کنید</option>
                                                    <?php $__currentLoopData = $propValue1->PropEnabledValues()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($prv->id); ?>" ><?php echo e($prv->prop_title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-12">
                                <?php if($propValue1->multi_assign==1): ?>
                                    <span class="text-left"><a href="javascript:void" onclick="createNewInstance('selectInstance<?php echo e($propValue1->id); ?>','selectContainer<?php echo e($propValue1->id); ?>')" >افزودن <?php echo e($propValue1->prop_title); ?> جدید</a></span>
                                <?php endif; ?>
                                </div>
                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row padding">
                        <div class="col-md-12">
                            <div class="form-group">

                            <label>توضیحات <?php echo e($pr->prop_title); ?>:</label>
                            <textarea rows="5" class="form-control" name="propDesc[<?php echo e($pr->id); ?>]" placeholder="توضیحات اضافی <?php echo e($pr->prop_title); ?> در این قسمت"><?php echo e((isset($villa)&&($VP=$villa->Properties()->withPivot(['text_value'])->where('property_id',$pr->id))->count()>0)? Helpers::br2nl($VP->first()->pivot->text_value):''); ?></textarea>
                            <?php if($errors->has('propDesc'.$pr->id)): ?><span class="help-block"><strong><?php echo e($errors->first('propDesc'.$pr->id)); ?></strong></span><?php endif; ?>
                            </div>
                        </div>
                        </div>


                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <script type="text/javascript">
            function createNewInstance(selectInstanceID,selectContainerID){
                html=$('#'+selectInstanceID).html();
                $('#'+selectContainerID).append(html);

            }
        </script>




        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">درباره اقامتگاه</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>متن توضیحات در مورد ویلا</label>
                            <textarea rows="5" class="form-control" name="villa_description" placeholder="توضیحات اضافی در این قسمت"><?php echo e(old('villa_description',isset($villa->villa_description) ? Helpers::br2nl($villa->villa_description) : '')); ?></textarea>
                            <?php if($errors->has('villa_description')): ?><span class="help-block"><strong><?php echo e($errors->first('villa_description')); ?></strong></span><?php endif; ?>
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
                            <textarea rows="2" class="form-control" name="villa_address" placeholder="آدرس"><?php echo e(old('villa_address',isset($villa->villa_address) ? Helpers::br2nl($villa->villa_address) : '')); ?></textarea>
                            <?php if($errors->has('villa_address')): ?><span class="help-block"><strong><?php echo e($errors->first('villa_address')); ?></strong></span><?php endif; ?>
                        </div>
                        <div id="map">
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


        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">وضعیت</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>وضعیت نهایی</label>

                            <select class="form-control" name="villa_status" required autocomplete="off">
                                <option <?php echo e((old('villa_status', isset($villa->villa_status) ? $villa->villa_status : '')==0)? 'selected':''); ?> value="0">تایید نشده</option>
                                <option <?php echo e((old('villa_status', isset($villa->villa_status) ? $villa->villa_status : '')==1)? 'selected':''); ?> value="1">تایید شده</option>
                            </select>
                            <?php if($errors->has('villa_status')): ?> <span class="help-block"><strong><?php echo e($errors->first('villa_status')); ?></strong></span> <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jsCustom'); ?>
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
        function getCities(th,elementID,selectTitle)
        {

            selected_city = $('#'+elementID).attr('data-selected') || null;
            $('#'+elementID).html('').fadeIn(800).append('<option value="0">لطفا کمی صبر کنید ...</option>');

            $.ajax({
                type: "POST",
                cache: false,
                url: '<?php echo e(url('ajax/get_province_cities')); ?>',
                data: {r_id:$(th).val()},
                dataType : 'text',
                success: function(data)
                {
                    var cities = $.parseJSON(data);

                    $('#'+elementID).html('').fadeIn(800).append('<option value="0">'+selectTitle+'</option>');
                    $.each(cities, function(i, city){
                        if(selected_city == city.id) $('#'+elementID).append('<option value="' + city.id + '" selected>' + city.city_name + '</option>');
                        else $('#'+elementID).append('<option value="' + city.id + '">' + city.city_name + '</option>');
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
            getCities(this,'city','انتخاب شهر');
        });
        $(document).on('change', '#city', function (e) {
            getCities(this,'district','انتخاب منطقه');
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
                position: {lat: <?php echo e((isset($villa->latitude) && ($villa->latitude!=Null && trim($villa->latitude)!=''))?$villa->latitude:'35.42323874580487'); ?>, lng: <?php echo e((isset($villa->latitude) && ($villa->longitude!=Null && trim($villa->longitude)!=''))?$villa->longitude:'52.07075264355467'); ?> },
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
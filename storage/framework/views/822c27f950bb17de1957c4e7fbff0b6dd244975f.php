<div class="sticky-form d-none d-lg-block">
    <div class="container">
        <form class="search" method="get" action="<?php echo e(route('search')); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="type" value="1">
            <div class="row">
                <div class="col-sm-6 col-md-2">
                    <div class="form-group arrow">
                        <select class="custom-select" id="state1" name="state" autocomplete="off">
                            <option <?php echo e((!old('state', isset($search->state) ? $search->state : '')? 'selected' : '')); ?> value="" >همه استانها</option>
                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(old('state', isset($search->state) ? $search->state : '')==$pr->id): ?> selected <?php endif; ?> value="<?php echo e($pr->id); ?>" ><?php echo e($pr->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group arrow">
                        <select class="custom-select" id="city1" name="city" autocomplete="off">
                            <option <?php echo e((!old('city', isset($search->city) ? \App\Models\City::find($search->city)->province()->first()->id : '')? 'selected' : '')); ?> value="" disabled>شهر را انتخاب کنید</option>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if(old('city', isset($search->city) ? $search->city : '')==$city->id): ?> selected <?php endif; ?> value="<?php echo e($city->id); ?>" ><?php echo e($city->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                        <input class="form-control" name="villa_code" type="text" placeholder="کد ملک" value="<?php echo e(old('villa_code', isset($search->villa_code) ? $search->villa_code : '')); ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group rent">
                        <input class="form-control" name="price" type="text" placeholder="" value="100.000 تومان">
                        <input type="hidden"  name="price_to_search" value="<?php echo e(old('price_to_search', isset($search->price_to_search) ? $search->price_to_search : '')); ?>" autocomplete="off">
                        <button class="button left" type="button" data-enevtsum="sum">+</button>
                        <button class="button" type="button" data-enevtsum="sub">-</button>

                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button class="btn btn-form">جستجو کن</button>

                    <!-- <a class="link-filter" href="" title="فیلتر ها">فیلتر ها</a> -->
                </div>
            </div>
        </form>
    </div>
</div>
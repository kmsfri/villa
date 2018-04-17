<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">فیلتر ها</h5>
                <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
            </div>
            <div class="modal-body">
                <form class="search">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group arrow">
                                <label>استان</label>
                                <select class="custom-select" id="state5" required="">
                                    <option value="0">همه استان ها</option>
                                    <?php if(count($states)): ?>
                                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($state->id); ?>"><?php echo e($state->city_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group arrow">
                                <label>شهر</label>
                                <select class="custom-select" id="city5" required="">
                                    <option value="0">همه شهر ها</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group area arrow">
                                <label>منطقه / محله</label>
                                <select class="custom-select" id="region5" required="">
                                    <option value="0">منطقه مورد نظر</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group code">
                                <label>کد ملک</label>
                                <input class="form-control" type="text" placeholder="کد ملک را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group type arrow">
                                <label>نوع ملک / ویلا</label>
                                <select class="custom-select" required="">
                                    <option value="">جنگلی</option>
                                    <option value="1">جنگلی</option>
                                    <option value="2">جنگلی</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button">فیلتر کن</button>
            </div>
        </div>
    </div>
</div>
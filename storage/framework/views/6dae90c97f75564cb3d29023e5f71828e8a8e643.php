<?php $__env->startSection('tableBody'); ?>
    <thead>
    <tr>
        <th scope="col">کدملک</th>
        <th class="width" scope="col">عنوان آگهی</th>
        <th scope="col">نرخ اجاره بها</th>
        <th scope="col">بروزرسانی</th>
        <th scope="col">ویــژه</th>
        <th scope="col">درخواست</th>
        <th scope="col">آمار</th>
        <th scope="col">وضعیت</th>
        <th scope="col">ویرایش</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">
            <input class="form-control" type="text">
        </th>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>

        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
    </tr>
    <?php $__currentLoopData = $villas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $villa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th class="number" scope="row"><?php echo e($villa->id); ?></th>
        <td>
            <p class="text"><?php echo e($villa->villa_title); ?></p>
        </td>
        <td>
            <input class="form-control rate" type="text" placeholder="<?php echo e($villa->rent_daily_price_from); ?> تومان">
        </td>
        <td><a class="update" href="<?php echo e(($villa->updated==1)?'javascript:void':Route('updateVilla',$villa->id)); ?>"><?php echo e(($villa->updated==1)?'بروز شده':'بروزرسانی'); ?></a></td>
        <td><a <?php if($villa->is_special==0): ?> data-toggle="modal" data-target="#specializeModal" onclick="$('#villa_id_to_specialize').val('<?php echo e($villa->id); ?>')" <?php endif; ?> class="special <?php echo e(($villa->is_special==1)?'active':''); ?>" href="javascript:void"><?php echo e(($villa->is_special==1)?'ویژه':'ویژه کن'); ?></a></td>
        <td><span class="request">39</span></td>
        <td><img class="img" onclick="show_visit(<?php echo e($villa->id); ?>);" src="<?php echo e(asset('images/icon097.png')); ?>"></td>
        <td>
            <p class="situation <?php echo e(($villa->villa_status==1)?'active':''); ?>"><?php echo e(($villa->villa_status==1)?'تایید شده':'تایید نشده'); ?></p>
        </td>
        <td><a href="<?php echo e(Route('editVillaForm',$villa->id)); ?>"><img class="img2" src="<?php echo e(asset('images/icon098.png')); ?>"></a></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <div class="modal fade" id="visitmodal" tabindex="-1" role="dialog" aria-labelledby="reportmodallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="rpform">
                    <input type="hidden" value="<?php echo e(csrf_token()); ?>" class="rptoken">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">آمار بازدید</h5>
                        <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <canvas id="VisitChart"></canvas>
                            </div>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="specializeModal" tabindex="-1" role="dialog" aria-labelledby="specializeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویژه کردن آگهی</h5>
                    <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                </div>

                <div class="modal-body">
                    <form id="chooseSpecializeTariffFrm" method="POST" action="<?php echo e(Route('specializeVilla')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="villa_id_to_specialize" id="villa_id_to_specialize" value="" autocomplete="off" required>
                        <div class="row">
                            <div class="col-sm-12">
                                یکی از تعرفه های زیر را انتخاب کنید.
                            </div>
                        </div>
                        <div class="row">
                            <?php $__currentLoopData = $tariffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tariff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <p>
                                    <h5><input type="radio" class="radio" name="tariffID" value="<?php echo e($tariff->id); ?>" required><?php echo e($tariff->tariff_title); ?></h5>
                                    <span>مدت زمان: <?php echo e($tariff->tariff_duration); ?> روز</span></br>
                                    <span>هزینه: <?php echo e($tariff->tariff_price); ?>تومان</span></br>
                                    <span>امتیاز مورد نیاز: <?php echo e($tariff->tariff_needed_points); ?></span></br>
                                    </p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>نحوه پرداخت</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input required type="radio" class="radio" name="payType" value="0">درگاه پرداخت</br>
                                <input required type="radio" class="radio" name="payType" value="1">پرداخت از امتیازات</br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button form="chooseSpecializeTariffFrm" class="btn btn-primary" type="submit">انجام</button>
                        </div>




                    </form>

                </div>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagination'); ?>
    <div class="pagination pull-left"><?php echo str_replace('/?', '?', $villas->render()); ?></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapscript'); ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>

    <script>
        function show_visit(id) {
            $.ajax({
                type: "GET",
                cache: false,
                url: '<?php echo e(url('VillaVisits')); ?>'+'/'+id,
                dataType : 'text',
                success: function(data)
                {
                    if (data == "error"){
                        alert('مشکلی در دریافت اطلاعات به وجود آمد.');
                        return false;
                    }
                    var visits = $.parseJSON(data);
                    var ctx = document.getElementById('VisitChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['امروز','24 ساعت گذشته','یک هفته','یک ماه'],
                            datasets: [{
                                label: 'بازدید',
                                data: [
                                    visits['today'],
                                    visits['last24'],
                                    visits['week'],
                                    visits['month'],
                                ],
                                backgroundColor: "rgba(153,255,51,0.6)"
                            }]
                        }
                    });
                    $("#visitmodal").modal()

                },
                error : function(data)
                {
                    alert('مشکلی در دریافت اطلاعات به وجود آمد.');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.masterLists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
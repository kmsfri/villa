<?php $__env->startSection('main'); ?>


    <div class="row">
        <div class="col-sm-6">
            <canvas id="VillaChart"></canvas>
        </div>
        <div class="col-sm-6">
            <canvas id="ContentChart"></canvas>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>آمار بازدید ویلاها بر اساس کد ویلا
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-vila" style="text-align: center;">
                                    <tr>
                                        <th scope="col">کد ویلا</th>
                                        <th scope="col">تعداد بازدید کل</th>
                                    </tr>
                                    <?php $__currentLoopData = $villa_visit_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vvt => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($vvt); ?></td>
                                            <td><?php echo e(count($value)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>آمار بازدید مطالب بر اساس کد مطلب
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-vila" style="text-align: center;">
                                    <tr>
                                        <th scope="col">کد مطلب</th>
                                        <th scope="col">تعداد بازدید کل</th>
                                    </tr>
                                    <?php $__currentLoopData = $content_visit_table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cvt => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($cvt); ?></td>
                                            <td><?php echo e(count($value)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>






<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapscript'); ?>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>
    <script >var ctx = document.getElementById('VillaChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['امروز','24 ساعت گذشته','یک هفته','یک ماه'],
                datasets: [{
                    label: 'بازدید',
                    data: [
                        <?php echo e($vtoday); ?> , <?php echo e($vlast24); ?> , <?php echo e($vweek); ?> , <?php echo e($vmonth); ?>

                    ],
                    backgroundColor: "rgba(153,255,51,0.6)"
                }]
            }
        });
        //# sourceURL=pen.js
    </script>
    <script >var ctx = document.getElementById('ContentChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['امروز','24 ساعت گذشته','یک هفته','یک ماه'],
                datasets: [{
                    label: 'بازدید مطالب',
                    data: [
                        <?php echo e($ctoday); ?> , <?php echo e($clast24); ?> , <?php echo e($cweek); ?> , <?php echo e($cmonth); ?>

                    ],
                    backgroundColor: "rgba(153,255,51,0.6)"
                }]
            }
        });
        //# sourceURL=pen.js
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
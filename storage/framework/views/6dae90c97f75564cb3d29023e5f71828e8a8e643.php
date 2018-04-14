<?php $__env->startSection('tableBody'); ?>
    <thead>
    <tr>
        <th scope="col">کدملک</th>
        <th class="width" scope="col">عنوان آگهی</th>
        <th scope="col">نرخ اجاره بها</th>
        <th scope="col">بروزرسانی</th>
        <th scope="col">ویــژه</th>
        <th scope="col">بروزرسانی</th>
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
        <td><a class="update" href="" title="بروزرسانی">بروزرسانی</a></td>
        <td><a class="special" href="">ویژه کن</a></td>
        <td><p class="text-update">بروز نشده</p></td>
        <td><span class="request">39</span></td>
        <td><img class="img" src="<?php echo e(asset('images/icon097.png')); ?>"></td>
        <td>
            <p class="situation <?php echo e(($villa->villa_status==1)?'active':''); ?>"><?php echo e(($villa->villa_status==1)?'تایید شده':'تایید نشده'); ?></p>
        </td>
        <td><a href="<?php echo e(Route('editVillaForm',$villa->id)); ?>"><img class="img2" src="<?php echo e(asset('images/icon098.png')); ?>"></a></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagination'); ?>
    <div class="pagination pull-left"><?php echo str_replace('/?', '?', $villas->render()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.masterLists', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
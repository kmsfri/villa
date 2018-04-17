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
    <?php echo $__env->make('user.web.common.centersearchbox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('user.web.common.villalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->startSection('jsmap'); ?>
    <script>
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
<?php $__env->startSection('main'); ?>


    <div class="header-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                    <ul class="ul-header">
                        <!-- <li><a class="login" href="" title="محمد قلعه نوئی">محمد قلعه نوئی</a></li> -->
                        <li><a class="record" href="" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
        <li><a href="" title="پیشخوان">پیشخوان</a></li>
        <li><a href="" title="ملک های من">جاذبه های گردشگری</a></li>
        <a class="btn btn-info pull-left" href="" title="ثبت رایگان ملک">افزدون مطلب گردشگری جدید <i class="fa fa-file"></i></a>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if( Session::has('data') ): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo e(Session::get('data')); ?>

                    </div>
                <?php endif; ?>
                <input class="form-control" type="text" id="myInput" onkeyup="search()" placeholder="جستجو در عنوان مطالب">
                <div class="table-responsive">
                    <table class="table table-bordered table-vila" id="myTable">
                        <thead>
                        <tr>
                            <th scope="col">کد مطلب</th>
                            <th scope="col">عنوان مطلب</th>
                            <th scope="col">شهر</th>
                            <th scope="col">تعداد نظرات</th>
                            <th scope="col">امتیاز تخصیص یافته</th>
                            <th scope="col">تعداد بازدید</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">عملیات</th>
                            <th scope="col">تاریخ انتشار</th>
                            <th scope="col">آخرین ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($contents)): ?>
                            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th class="number" scope="row"><?php echo e($content->id); ?></th>
                                    <td>
                                        <p class="text"><?php echo e($content->content_title); ?></p>
                                        <?php if($content->content_status != 0): ?>
                                            <a href="#" class="btn btn-bloglink">لینک مطلب</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <p class="text"><?php echo e($content->Cities()->first()->city_name); ?></p>
                                    </td>
                                    <td><p class="text"><?php echo e($content->RenterUserComments()->count()); ?></p></td>
                                    <td><p class="text"><?php echo e($content->RenterUserScores()->count()); ?></p></td>
                                    <td>
                                        <p class="text"><?php echo e($content->view_count); ?></p>
                                    </td>
                                    <td>
                                        <?php if($content->content_status != 1): ?>
                                            <p class="situation">تایید نشده</p>
                                        <?php else: ?>
                                            <p class="situation active">تایید شده</p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('editcontent',$content->id)); ?>" data-toggle="tooltip" title="ویرایش"><i class="fa fa-pencil"></i></a>
                                        <?php if($content->show_in_body != 0): ?>
                                            <a href="<?php echo e(route('showinbody',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="عدم نمایش در بالای بلاگ"><i class="fa fa-eye-slash"></i></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('showinbody',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="نمایش در بالای بلاگ"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                        <br>
                                        <a href="#" data-toggle="tooltip" title="درخواست حذف"><i class="fa fa-trash"></i></a>
                                        <?php if($content->is_draft != 0): ?>
                                        <a href="<?php echo e(route('draft',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="وضعیت:پیش نویس"><i class="fa fa-sticky-note"></i></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('draft',$content->id)); ?>" onclick="confirmaction();" data-toggle="tooltip" title="وضعیت:نهایی"><i class="fa fa-check"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <p class="text"><?php echo e(Helpers::convert_date_g_to_j($content->created_at,true)); ?><br><?php echo e($content->created_at->format('H:i:s')); ?></p>
                                    </td>
                                    <td><p class="text"><?php echo e(Helpers::convert_date_g_to_j($content->updated_at,true)); ?><br><?php echo e($content->updated_at->format('H:i:s')); ?></p></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination pull-left"><?php echo str_replace('/?', '?', $contents->render()); ?></div>


            </div>
        </div>
    </div>






<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapscript'); ?>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        function confirmaction() {
            var r = confirm("آیا از انجام این عملیات مطمئن هستید؟");
            if (r == true) {
                return true;
            } else {
                event.preventDefault();
                return false;
            }

        }
    </script>

    <script>
        function search() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.dashboard.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
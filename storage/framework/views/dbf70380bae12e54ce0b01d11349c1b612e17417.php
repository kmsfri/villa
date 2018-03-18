<!DOCTYPE html>
<html lang="fa">
<head>
  <link rel="icon" href="<?php echo asset('admin/uploads/static/fav.png'); ?>" type="image/x-icon" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>پنل مدیریت</title>
  <script type="text/javascript" src="<?php echo asset('admin/bootstrap-3.3.7/js/jquery.min.js'); ?>"></script>
  <link href="<?php echo asset('admin/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <script type="text/javascript" src="<?php echo asset('admin/bootstrap-3.3.7/js/bootstrap.min.js'); ?>"></script>
  <link href="<?php echo asset('admin/css/sb-admin-2.css'); ?>" rel="stylesheet">
  <link href="<?php echo asset('admin/css/font-awesome/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php echo $__env->yieldContent('cssFiles'); ?>
  <?php echo $__env->yieldContent('jsFiles'); ?>
</head>
<body>
<div id="wrapper">
    <?php echo $__env->make('admin.common.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(session('messages')): ?>
      <div class="row submit-messages">
        <ul>
            <?php $__currentLoopData = session('messages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($msg); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo asset('admin/js/jquery-1.11.0.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('admin/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('admin/js/metisMenu/metisMenu.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo asset('admin/js/sb-admin-2.js'); ?>"></script>
<?php echo $__env->yieldContent('jsCustom'); ?>
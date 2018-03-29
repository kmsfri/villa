<?php $__env->startSection('content'); ?>
<div class="row"><div class="col-lg-12"><h1 class="page-header">پیشخوان</h1></div></div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge">0</div>
                        <div>ویلای جدید</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-right">نمایش جزئیات</span>
                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge">0</div>
                        <div>تعداد کاربران</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-right">نمایش جزئیات</span>
                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge">0</div>
                        <div>پیام های جدید</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-right">نمایش جزئیات</span>
                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-inbox fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge">0</div>
                        <div>مطالب گردشگری جدید</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-right">نمایش جزئیات</span>
                    <span class="pull-left"><i class="fa fa-arrow-circle-left"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>آمار بازدید
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
@extends('admin.master')
@section('content')
<div class="row"><div class="col-lg-12"><h1 class="page-header">داشبورد</h1></div></div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge">0</div>
                        <div>نظر جدید</div>
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
                        <div>کاربر</div>
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
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <div class="huge">0</div>
                        <div>سفارش جدید</div>
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
                        <div>پیام جدید</div>
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
                <i class="fa fa-bar-chart-o fa-fw"></i> فاکتورهای اخیر
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"></td>
                                    <td class="text-left">
                                        <center>
                                            ردیف
                                        </center>
                                    </td>

                                    <td class="text-left">
                                        <center>
                                            خریدار
                                        </center>
                                    </td>
                                    <td class="text-right">
                                        <center>
                                            مبلغ قابل پرداخت
                                        </center>
                                    </td>
                                    <td class="text-right">
                                        <center>
                                            وضعیت پرداخت
                                        </center>
                                    </td>
                                    <td class="text-right">
                                        <center>
                                            عملیات
                                        </center>
                                    </td>

                                </tr>

                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@stop
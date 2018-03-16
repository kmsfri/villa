@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>{!! $title  !!}
                    <div class="pull-left">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">عملیات<span class="caret"></span></button>
                            @if($add_url!=Null || $del_url!=Null)
                                <ul class="dropdown-menu pull-left" role="menu">
                                    @if($add_url!=Null) <li><a href="{{$add_url}}" class="btn btn-btn1-cs1">افزودن</a></li>@endif
                                    @if($del_url!=Null)
                                        <li><a href="{{$del_url}}" onclick="$('#delForm').submit(); return false;" class="btn btn-btn1-cs1">حذف انتخاب شده ها</a></li>
                                        <form id="delForm" action="{{$del_url}}" method="post" onsubmit="return confirm('آیا از حذف آگهی های انتخاب شده مطمئنید؟');">
                                            {{ csrf_field() }}
                                        </form>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover list-table">
                                    @yield('content_list')
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
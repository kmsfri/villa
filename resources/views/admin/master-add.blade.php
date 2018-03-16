@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bar-chart-o fa-fw"></i>{!! $title  !!}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if($request_type=='edit')
                                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url($post_edit_url) }}" autocomplete="off">
                                <input type="hidden" name="edit_id" value="{{ old('edit_id',isset($edit_id) ? $edit_id : '') }}">
                            @else
                                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url($post_add_url) }}">
                            @endif
                            {{ csrf_field() }}
                                    @yield('content_add_form')
                                    <div class="form-group">
                                        <div class="col-md-3 pull-left">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-sign-in"></i> ذخیره
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
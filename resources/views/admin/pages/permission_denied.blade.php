@extends('admin.master-lists')
@section('content_list')
    <div class="row">
        <div class="col-lg-12">
            <div class="title1">
                <h3>اخطار</h3>
                <hr class="hr2">
            </div>
        </div>
    </div>
    <div class="admin-content-cont">
        <center><h4>{{$err_msg}}</h4></center>
    </div>

@stop
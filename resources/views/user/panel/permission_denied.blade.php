@extends('user.panel.master')
@section('main')
<div class="box-panel">
    <div class="header">
        <h3>اخطار</h3>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group text-center">
                    <h4>{{$err_msg}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
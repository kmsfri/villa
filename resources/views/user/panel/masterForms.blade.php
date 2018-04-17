@extends('user.panel.master')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="post" action="{{$actionURL}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="edit_id" value="@if(isset($edit_id)) {{$edit_id}} @endif">
                    @include('user.panel.common.alerts')
                    @yield('formBody')
                    @if($actionURL!=Null)
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">عملیات</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                            <button class="btn btn-primary pull-right" type="submit">
                                {{(isset($saveButtonTitle))?$saveButtonTitle:'ذخیره'}}
                            </button>
                            </div>
                        </div>
                    </div>
                     @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('admin.master-add')
@section('content_add_form')
    <div class="row">
    @foreach($routes as $route)
        <div class="col-lg-4 pull-right">
            <div class="checkbox">
                <label ><input type="checkbox" name="routes_assign_to_user[]"  value="{{$route->id}}" {{($route->permited==1)? 'checked' : ''}}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$route->route_title}}</label>
            </div>
        </div>
    @endforeach
    </div>
    </br></br></br>
@stop
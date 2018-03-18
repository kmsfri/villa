@extends('admin.master-add')
@section('content_add_form')
    <input type="hidden" name="parent_id" value="{{ old('parent_id',isset($parent_id) ? $parent_id : Null) }}">
    <div class="form-group{{ $errors->has('city_name') ? ' has-error' : '' }}">
        <!-- change -->
        <label for="city_name" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="city_name" value="{{ old('city_name',isset($city->city_name) ? $city->city_name : '') }}">
            @if ($errors->has('city_name'))
                <span class="help-block">
                            <strong>{{ $errors->first('city_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('city_description') ? ' has-error' : '' }}">
        <!-- change -->
        <label for="city_description" class="col-md-2 pull-right control-label">توضیحات:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" name="city_description">{{ old('city_description',isset($city->city_description) ? Helpers::br2nl($city->city_description) : '') }}</textarea>
            @if ($errors->has('city_description'))
                <span class="help-block">
                            <strong>{{ $errors->first('city_description') }}</strong>
                        </span>
            @endif
        </div>
    </div>




    <div class="form-group{{ $errors->has('city_order') ? ' has-error' : '' }}">
        <!-- change -->
        <label for="city_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <!-- change -->
            <select  name='city_order' class='selectpicker form-control pull-right'>
                @for($i=1; $i<=20; $i++)
                    <option @if(old('city_order' , isset($city->city_order) ? $city->city_order : '')==$i) selected @endif value="{{$i}}" >{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has('city_order'))
                <span class="help-block">
                            <strong>{{ $errors->first('city_order') }}</strong>
                        </span>
            @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('city_status') ? ' has-error' : '' }}">
        <!-- change -->
        <label for="city_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <!-- change -->
            <select  name='city_status' class='selectpicker form-control pull-right'>
                <option @if(old('city_status' , isset($city->city_status) ? $city->city_status : '')==1) selected @endif value="1" >فعال</option>
                <option @if(old('city_status' , isset($city->city_status) ? $city->city_status : '')==0) selected @endif value="0" >غیر فعال</option>
            </select>
            @if ($errors->has('city_status'))
                <span class="help-block">
                            <strong>{{ $errors->first('city_status') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@stop

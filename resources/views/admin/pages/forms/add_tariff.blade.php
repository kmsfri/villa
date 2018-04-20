@extends('admin.master-add')
@section('content_add_form')
    <div class="form-group{{ $errors->has('tariff_title') ? ' has-error' : '' }}">
        <label for="tariff_title" class="col-md-2 pull-right control-label">عنوان تعرفه:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="tariff_title" value="{{ old('tariff_title',isset($tariff->tariff_title) ? $tariff->tariff_title : '') }}" autocomplete="off">
            @if ($errors->has('tariff_title'))<span class="help-block"><strong>{{ $errors->first('tariff_title') }}</strong></span>@endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('tariff_duration') ? ' has-error' : '' }}">
        <label for="tariff_duration" class="col-md-2 pull-right control-label">مدت زمان:</label>
        <div class="col-md-6 pull-right">
            <select  name='tariff_duration' class='selectpicker form-control pull-right'>
                @for($i=1; $i<=90; $i++)
                    <option @if(old('tariff_duration' , isset($tariff->tariff_duration) ? $tariff->tariff_duration : '')==$i) selected @endif value="{{$i}}" >{{$i}} روز</option>
                @endfor
            </select>
            @if ($errors->has('tariff_duration')) <span class="help-block"><strong>{{ $errors->first('tariff_duration') }}</strong></span> @endif
        </div>
    </div>




    <div class="form-group{{ $errors->has('tariff_price') ? ' has-error' : '' }}">
        <label for="tariff_price" class="col-md-2 pull-right control-label">قیمت(تومان):</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="tariff_price" value="{{ old('tariff_price',isset($tariff->tariff_price) ? $tariff->tariff_price : '') }}" autocomplete="off">
            @if ($errors->has('tariff_price'))<span class="help-block"><strong>{{ $errors->first('tariff_price') }}</strong></span>@endif
        </div>
    </div>



    <div class="form-group{{ $errors->has('tariff_needed_points') ? ' has-error' : '' }}">
        <label for="tariff_needed_points" class="col-md-2 pull-right control-label">امتیاز مورد نیاز:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="tariff_needed_points" value="{{ old('tariff_needed_points',isset($tariff->tariff_needed_points) ? $tariff->tariff_needed_points : '') }}" autocomplete="off">
            @if ($errors->has('tariff_needed_points'))<span class="help-block"><strong>{{ $errors->first('tariff_needed_points') }}</strong></span>@endif
        </div>
    </div>





    <div class="form-group{{ $errors->has('tariff_status') ? ' has-error' : '' }}">
        <label for="tariff_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='tariff_status' class='selectpicker form-control pull-right' autocomplete="off">
                <option @if(old('tariff_status' ,isset($tariff->tariff_status) ? $tariff->tariff_status : '' )==1) selected @endif value="1" >فعال</option>
                <option @if(old('tariff_status' , isset($tariff->tariff_status) ? $tariff->tariff_status : '')==0) selected @endif value="0" >غیر فعال</option>
            </select>
            @if ($errors->has('tariff_status'))<span class="help-block"><strong>{{ $errors->first('tariff_status') }}</strong></span>@endif
        </div>
    </div>


@stop
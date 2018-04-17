@extends('admin.master-add')
@section('content_add_form')
    <div class="form-group{{ $errors->has('villa_type_title') ? ' has-error' : '' }}">
        <label for="villa_type_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="villa_type_title" value="{{ old('villa_type_title',isset($villaType->villa_type_title) ? $villaType->villa_type_title : '') }}" autocomplete="off">
            @if ($errors->has('villa_type_title'))<span class="help-block"><strong>{{ $errors->first('villa_type_title') }}</strong></span>@endif
        </div>
    </div>



    <div class="form-group{{ $errors->has('villa_type_order') ? ' has-error' : '' }}">
        <label for="villa_type_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='villa_type_order' class='selectpicker form-control pull-right'>
                @for($i=1; $i<=20; $i++)
                    <option @if(old('villa_type_order' , isset($villaType->villa_type_order) ? $villaType->villa_type_order : '')==$i) selected @endif value="{{$i}}" >{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has('villa_type_order')) <span class="help-block"><strong>{{ $errors->first('villa_type_order') }}</strong></span> @endif
        </div>
    </div>




@stop
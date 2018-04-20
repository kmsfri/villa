@extends('admin.master-add')
@section('content_add_form')
    @if(count($errors)>0)
        {{dd($errors)}}
    @endif

    <input type="hidden" name="parent_id" value="{{ old('parent_id',isset($parent_id) ? $parent_id : Null) }}">
    <div class="form-group{{ $errors->has('link_title') ? ' has-error' : '' }}">
        <label for="link_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="link_title" value="{{ old('link_title',isset($link->link_title) ? $link->link_title : '') }}">
            @if ($errors->has('link_title'))
                <span class="help-block"><strong>{{ $errors->first('link_title') }}</strong></span>
            @endif
        </div>
    </div>



    <div class="form-group{{ $errors->has('link_url') ? ' has-error' : '' }}">
        <label for="link_url" class="col-md-2 pull-right control-label">لینک:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="link_url" value="{{ old('link_url',isset($link->link_url) ? $link->link_url : '') }}">
            @if ($errors->has('link_url'))
                <span class="help-block"><strong>{{ $errors->first('link_url') }}</strong></span>
            @endif
        </div>
    </div>




    <div class="form-group{{ $errors->has('link_order') ? ' has-error' : '' }}">
        <label for="link_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='link_order' class='selectpicker form-control pull-right'>
                @for($i=1; $i<=40; $i++)
                    <option @if(old('link_order' , isset($link->link_order) ? $link->link_order : '')==$i) selected @endif value="{{$i}}" >{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has('link_order'))
                <span class="help-block"><strong>{{ $errors->first('link_order') }}</strong></span>
            @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('link_status') ? ' has-error' : '' }}">
        <label for="link_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='link_status' class='selectpicker form-control pull-right'>
                <option @if(old('link_status' , isset($link->link_status) ? $link->link_status : '')==1) selected @endif value="1" >فعال</option>
                <option @if(old('link_status' , isset($link->link_status) ? $link->link_status : '')==0) selected @endif value="0" >غیر فعال</option>
            </select>
            @if ($errors->has('link_status'))
                <span class="help-block"><strong>{{ $errors->first('link_status') }}</strong></span>
            @endif
        </div>
    </div>
@stop
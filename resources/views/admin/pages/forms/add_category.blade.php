@extends('admin.master-add')
@section('content_add_form')
    <input type="hidden" name="parent_id" value="{{ old('parent_id',isset($parent_id) ? $parent_id : Null) }}">
    <div class="form-group{{ $errors->has('category_title') ? ' has-error' : '' }}">
        <label for="category_title" class="col-md-2 pull-right control-label">عنوان:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="category_title" value="{{ old('category_title',isset($category->category_title) ? $category->category_title : '') }}">
            @if ($errors->has('category_title'))
                <span class="help-block"><strong>{{ $errors->first('category_title') }}</strong></span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('category_slug_corrected') ? ' has-error' : '' }}">
        <label for="category_slug" class="col-md-2 pull-right control-label">کلمات کلیدی آدرس:</label>
        <div class="col-md-6 pull-right">
            <input type="text" class="form-control" name="category_slug" value="{{ old('category_slug',isset($category->category_slug) ? $category->category_slug : '') }}">
            @if ($errors->has('category_slug_corrected'))
                <span class="help-block"><strong>{{ $errors->first('category_slug_corrected') }}</strong></span>
            @endif
        </div>
    </div>






    <div class="form-group{{ $errors->has('category_order') ? ' has-error' : '' }}">
        <label for="category_order" class="col-md-2 pull-right control-label">ترتیب:</label>
        <div class="col-md-6 pull-right">
            <select  name='category_order' class='selectpicker form-control pull-right'>
                @for($i=1; $i<=40; $i++)
                    <option @if(old('category_order' , isset($category->category_order) ? $category->category_order : '')==$i) selected @endif value="{{$i}}" >{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has('category_order'))
                <span class="help-block"><strong>{{ $errors->first('category_order') }}</strong></span>
            @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('category_status') ? ' has-error' : '' }}">
        <label for="category_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='category_status' class='selectpicker form-control pull-right'>
                <option @if(old('category_status' , isset($category->category_status) ? $category->category_status : '')==1) selected @endif value="1" >فعال</option>
                <option @if(old('category_status' , isset($category->category_status) ? $category->category_status : '')==0) selected @endif value="0" >غیر فعال</option>
            </select>
            @if ($errors->has('category_status'))
                <span class="help-block"><strong>{{ $errors->first('category_status') }}</strong></span>
            @endif
        </div>
    </div>


    @if(isset($ctg_type) && $ctg_type='category3')
        <div class="form-group{{ $errors->has('show_in_blog') ? ' has-error' : '' }}">
            <label for="show_in_blog" class="col-md-2 pull-right control-label">نمایش در وبلاگ:</label>
            <div class="col-md-6 pull-right">
                <select  name='show_in_blog' class='selectpicker form-control pull-right'>
                    <option @if(old('show_in_blog' , isset($category->show_in_blog) ? $category->show_in_blog : '')==1) selected @endif value="1" >بله</option>
                    <option @if(old('show_in_blog' , isset($category->show_in_blog) ? $category->show_in_blog : '')==0) selected @endif value="0" >خیر(عدم نمایش)</option>
                </select>
                @if ($errors->has('show_in_blog'))
                    <span class="help-block"><strong>{{ $errors->first('show_in_blog') }}</strong></span>
                @endif
            </div>
        </div>
    @endif







@stop

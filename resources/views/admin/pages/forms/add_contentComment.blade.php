@extends('admin.master-add')
@section('content_add_form')


    <div class="form-group{{ $errors->has('comment_text') ? ' has-error' : '' }}">
        <label for="comment_text" class="col-md-2 pull-right control-label">متن نظر:</label>
        <div class="col-md-6 pull-right">
            <textarea class="form-control" rows="10" name="comment_text">{{ old('comment_text',isset($comment->comment_text) ? Helpers::br2nl($comment->comment_text) : '') }}</textarea>
            @if ($errors->has('comment_text'))
                <span class="help-block"><strong>{{ $errors->first('comment_text') }}</strong></span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('comment_status') ? ' has-error' : '' }}">
        <label for="comment_status" class="col-md-2 pull-right control-label">وضعیت:</label>
        <div class="col-md-6 pull-right">
            <select  name='comment_status' class='selectpicker form-control pull-right' autocomplete="off">
                <option @if(old('comment_status' , isset($comment->comment_status) ? $comment->comment_status : '')==0) selected @endif value="0" >غیرفعال</option>
                <option @if(old('comment_status' ,isset($comment->comment_status) ? $comment->comment_status : '' )==1) selected @endif value="1" >فعال</option>
            </select>
            @if ($errors->has('comment_status'))<span class="help-block"><strong>{{ $errors->first('comment_status') }}</strong></span>@endif
        </div>
    </div>



@stop
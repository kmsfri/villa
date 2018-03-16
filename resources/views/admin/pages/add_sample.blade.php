@extends('admin.master-add')
@section('content_add_form')
<div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
    <label for="user_name" class="col-md-2 pull-right control-label">نام کاربری:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="user_name" value="{{ old('user_name',isset($u->user_name) ? $u->user_name : '') }}" autocomplete="off">
        @if ($errors->has('user_name'))<span class="help-block"><strong>{{ $errors->first('user_name') }}</strong></span>@endif
    </div>
</div>
<div class="form-group{{ $errors->has('user_title') ? ' has-error' : '' }}">
    <label for="user_title" class="col-md-2 pull-right control-label">نام و نام خانوادگی:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="user_title" value="{{ old('user_title',isset($u->user_title) ? $u->user_title : '') }}" autocomplete="off">
        @if ($errors->has('user_title'))<span class="help-block"><strong>{{ $errors->first('user_title') }}</strong></span>@endif
    </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-2 pull-right control-label">ایمیل:</label>
    <div class="col-md-6 pull-right">
        <input type="text" class="form-control" name="email" value="{{ old('email',isset($u->email) ? $u->email : '') }}" autocomplete="off">
        @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
    </div>
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-2 pull-right control-label">رمز عبور:</label>
    <div class="col-md-6 pull-right">
        <input type="password" class="form-control" name="password" value="{{ old('password',isset($u->password) ? '**||password-no-changed' : '') }}" autocomplete="off">
        @if ($errors->has('password'))<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>@endif
    </div>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-2 pull-right control-label">توضیحات:</label>
    <div class="col-md-6 pull-right">
        <textarea class="form-control" name="description">{{ old('description',isset($u->description) ? Helpers::br2nl($u->description) : '') }}</textarea>
        @if ($errors->has('description'))<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>@endif
    </div>
</div>
<div class="form-group{{ $errors->has('user_status') ? ' has-error' : '' }}">
    <label for="user_status" class="col-md-2 pull-right control-label">وضعیت:</label>
    <div class="col-md-6 pull-right">
        <select  name='user_status' class='selectpicker form-control pull-right' autocomplete="off">
            <option @if(old('user_status' ,isset($u->user_status) ? $u->user_status : '' )==1) selected @endif value="1" >فعال</option>
            <option @if(old('user_status' , isset($u->user_status) ? $u->user_status : '')==0) selected @endif value="0" >غیر فعال</option>
        </select>
        @if ($errors->has('user_status'))<span class="help-block"><strong>{{ $errors->first('user_status') }}</strong></span>@endif
    </div>
</div>
@stop

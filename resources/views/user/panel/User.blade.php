@extends('user.panel.masterForms')
@section('formBody')
<div class="box-panel padding">
    <div class="header">
        <h3 class="title-box">اطلاعات تکمیلی</h3><br>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-6">
                <div class="box-small">
                    <p>تصویر کاربر</p>
                    <input type="file" name="image">
                    @if ($errors->has('image')) <span class="help-block"><strong>{{ $errors->first('image') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>* نام و نام خانوادگی</label>
                    <input class="form-control" type="text" value="{{ old('fullname',isset($user->fullname) ? $user->fullname : '') }}" name="fullname" required>
                    @if ($errors->has('fullname')) <span class="help-block"><strong>{{ $errors->first('fullname') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>* موبایل</label>
                    <input class="form-control" type="text" value="{{$user->mobile_number}}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-panel">
    <div class="header">
        <h3 class="title-box">آدرس های پروفایل</h3><br>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>* آدرس</label>
                    <input class="form-control" type="text" name="address" value="{{ old('address',isset($user->address) ? $user->address : '') }}" required>
                    @if ($errors->has('address')) <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>* آدرس پروفایل شما(آدرس باید شامل عدد و حروف انگلیسی باشد- a-z 0-9)</label>
                    <div class="input-group">
                        <input class="form-control"  id="basic-url" aria-describedby="basic-addon3" style="direction: ltr" type="text" name="profile_slug" value="{{ old('profile_slug',isset($user->profile_slug) ? $user->profile_slug : '') }}" @if(isset($user->profile_slug)) readonly @endif required>
                        <span class="input-group-addon" id="basic-addon3">https://villayar.com/</span>
                    </div>
                    @if( Session::has('uniq') )
                        <span class="help-block" style="color:red;font-size: 12px;">{{ Session::get('uniq') }}</span><br>
                    @endif
                    @if(!isset($user->profile_slug))
                        <span class="help-block">بعد از مشخص نمودن این مقدار، دیگر نمی توانید آن را تغییر دهید</span><br>
                    @endif
                    @if ($errors->has('profile_slug')) <span class="help-block"><strong>{{ $errors->first('profile_slug') }}</strong></span> @@endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-panel">
    <div class="header">
        <h3 class="title-box">رمز عبور</h3><br>
        <span class="help-block" style="color:red;font-size: 12px;">تنها در صورتی که رمز عبور خود را تغییر می دهید، مقادیر زیر را ویرایش کنید</span>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>* رمز عبور جدید</label>
                    <input class="form-control" name="password" type="password" value="**||password-no-changed" required>


                    @if ($errors->has('password')) <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>* تکرار رمز عبور جدید</label>
                    <input class="form-control" name="repassword" type="password" value="**||password-no-changed" required>
                    @if ($errors->has('repassword')) <span class="help-block"><strong>{{ $errors->first('repassword') }}</strong></span> @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

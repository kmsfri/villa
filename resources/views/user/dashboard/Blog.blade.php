@extends('user.dashboard.master')
@section('main')


    <div class="header-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                    <ul class="ul-header">
                        <!-- <li><a class="login" href="" title="محمد قلعه نوئی">محمد قلعه نوئی</a></li> -->
                        <li><a class="record" href="" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
        <li><a href="" title="پیشخوان">پیشخوان</a></li>
        <li><a href="" title="ملک های من">ویرایش اطلاعات بلاگ</a></li>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="post" action="{{route('blogaction')}}">
                    {{csrf_field()}}
                    <div class="box-panel padding">
                        @if( Session::has('data') )
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('data') }}
                            </div>
                        @endif
                        <div class="header">
                            <h3 class="title-box">اطلاعات نوشتاری بلاگ</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>* عنوان بلاگ</label>
                                        <input class="form-control" type="text" value="{{ old('blog_title',isset($user->blog_title) ? $user->blog_title : '') }}" name="blog_title" required>
                                        @if ($errors->has('blog_title')) <span class="help-block"><strong>{{ $errors->first('blog_title') }}</strong></span> @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>* توضیحات بلاگ</label>
                                        <input class="form-control" type="text" value="{{ old('blog_description',isset($user->blog_description) ? $user->blog_description : '') }}" name="blog_description" required>
                                        @if ($errors->has('blog_description')) <span class="help-block"><strong>{{ $errors->first('blog_description') }}</strong></span> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">آدرس های شبکه اجتماعی</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> تلگرام</label>
                                        <div class="input-group">
                                            <input class="form-control" aria-describedby="telegram" type="text" name="telegram_link" value="{{ old('telegram_link',isset($user->telegram_link) ? $user->telegram_link : '') }}">

                                            <span class="input-group-addon" id="telegram">https://t.me/</span>
                                        </div>
                                        @if ($errors->has('telegram_link')) <span class="help-block"><strong>{{ $errors->first('telegram_link') }}</strong></span> @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> اینستاگرام</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" aria-describedby="instagram" name="instagram_link" value="{{ old('instagram_link',isset($user->instagram_link) ? $user->instagram_link : '') }}">

                                            <span class="input-group-addon" id="instagram">https://instagram.com/</span>
                                        </div>
                                        @if ($errors->has('instagram_link')) <span class="help-block"><strong>{{ $errors->first('instagram_link') }}</strong></span> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary pull-left" type="submit">ذخیره</button>
                </form>
            </div>
        </div>
    </div>






@endsection
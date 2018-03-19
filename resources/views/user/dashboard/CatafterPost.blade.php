@extends('master')
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
        <li><a href="" title="جاذبه های گردشگری">جاذبه های گردشگری</a></li>
        <li><a href="" title="ملک های من">افزودن جاذبه های گردشگری</a></li>
        <li><a href="" title="انتخاب دسته بندی">انتخاب دسته بندی</a></li>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="get" action="" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-panel padding">
                        @if( Session::has('data') )
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('data') }}
                            </div>
                        @endif
                        <div class="header">
                            <h3 class="title-box">انتخاب دسته بندی ها(انتخاب دسته بندی اجباری نیست)</h3><br>

                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <input type="checkbox" name="cat[]"> دسته بندی اصلی<br><br>
                            <a href="#" id="1" style="color:#d26b6b">نمایش زیر دسته های این دسته بندی</a><br>
                        </div>
                        <div class="data" id="check1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="cat[]"> دسته بندی اصلی
                                        <input type="checkbox" name="cat[]"> دسته بندی اصلی
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

@section('mapscript')

    <script type="text/javascript">
        $('#check1').hide();
        $('#1').click(function(){

            $('#check1').slideToggle();


        });
    </script>

@endsection

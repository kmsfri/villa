@extends('user.web.master')
@section('header')
    @include('user.web.common.header')
@endsection
@section('main')
    @include('user.web.common.stickyheadsearch')
    @include('user.web.common.responsivesearch')
    @if(count($categories1))
    <a class="filter" href="" title="Filter"><img src="{{asset('users/img/ic_filter_icon.png')}}" alt=""></a>
    <ul class="ul-rent">
        @foreach($categories1 as $category1)
        <li><a href="" title="{{$category1->category_title}}"><img src="" alt="{{$category1->category_title}}">{{$category1->category_title}}</a></li>
        @endforeach
    </ul>
    @endif
    <!--start section search-->
    @include('user.web.common.centersearchbox')
    <!--end section search-->

    <!--start section vila-->
    @include('user.web.common.villalist')
    <!--end section vila-->

    <!--start section tourism-->
    @include('user.web.common.contents-slider')
    <!--end section tourism-->
    <!--section Follow up-->
    <section class="follow-up">
        <div class="container">
            @if(count($categories1))
            <div class="text-center">
                <h2 class="title-follow">دنبال چه ویلایی میگردی ؟</h2>
                <p class="description">امکان جستجو ویلا بر اساس نوع ویلا رو براتون فراهم کردیم</p>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    <div class="row">
                        @foreach($categories1 as $category1)
                        <div class="col-sm-6 col-md-6 col-lg-4">
                            <div class="box-follow-up">
                                <figure><img src="{{asset($category1->img1)}}" alt=""><img class="img" src="{{asset($category1->img_hover)}}" alt="{{$category1->category_title}}"></figure>
                                <h3 class="title">{{$category1->category_title}}</h3>
                                <div class="link"><a href="" title="نمایش ویلاها">نمایش ویلاها</a></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <div class="text-center">
                <h2 class="title-follow m-t-50">کاربران در مورد ما چه میگوید ؟</h2>
                <p class="description">بخشی از نظرات کاربران در مورد ویلایار</p>
            </div>
            @if($websitecomments)
            <div class="slider-comment">
                @foreach($websitecomments as $websitecomment)
                <div class="item"><img src="{{asset('images/users/user-uploads/user-pics').'/'.$websitecomment->WritenBy()->first()->avatar_dir}}" alt=""/>
                    <p>{{$websitecomment->comment_text}}</p>
                    <p class="text-name">{{$websitecomment->WritenBy()->first()->fullname}}</p>
                </div>
                @endforeach
            </div>
            @endif
            <div class="text-center"><a class="btn-comment" href="" data-toggle="modal" data-target="#commentmodal" title="ارسال نظرات">ارسال نظرات</a></div>
        </div>
    </section>
    <!--end section Follow up-->
    <!--start modal-->
    <script>
        $(document).ready(function(){
            $(document).on('click', 'span#close_first_modal', function(){
                $('#filterModal').modal('toggle');
            });
        });
    </script>
    <div class="modal fade" id="commentmodal" tabindex="-1" role="dialog" aria-labelledby="commentmodallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{route('savewebsitecomment')}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارسال نظر شما درباره وبسایت</h5>
                    <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                </div>
                <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                                @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
                                    {{csrf_field()}}
                                    <textarea name="websitecomment" rows="5" style="width: 100%" type="text" placeholder="نظر خود را وارد نمایید" required></textarea>
                                @else
                                <p>برای ثبت نظر باید وارد وبسایت شوید.</p>
                                @endif
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
                    <button class="btn btn-primary" type="submit">ارسال</button>
                    @endif

                </div>
                </form>
            </div>
        </div>
    </div>
    @include('user.web.common.filtermodal')

    @if( Session::has('errorcomment') )
        {!! Session::get('errorcomment') !!}

    @endif

    @section('jsmap')
        <script>
            function list_villa_rate(s_value,vid) {
                $.post("{{route('rate_villa_list')}}",
                    {
                        s_value: s_value,
                        villa_id:vid
                    } ,
                    function(data){
                        if(data != "ok"){
                            alert('مشکلی در ثبت امتیاز به وجود آمده است، در صورت بروز مجدد، صفحه را دوباره رفرش کنید');
                        }

                    })
                    .fail(function() {
                        alert( "شما باید وارد حساب کاربری خود شوید" );
                        window.location = "{{route('showlogin')}}";
                    })
            }
            function getCities(th,id)
            {

                selected_city = $('#'+id).attr('data-selected') || null;
                $('#'+id).html('').fadeIn(800).append('<option value="">لطفا کمی صبر کنید ...</option>');

                $.ajax({
                    type: "POST",
                    cache: false,
                    url: '{{url('ajax/get_province_cities')}}',
                    data: {r_id:$(th).val()},
                    dataType : 'text',
                    success: function(data)
                    {
                        var cities = $.parseJSON(data);

                        $('#'+id).html('').fadeIn(800).append('<option value="">انتخاب کنید</option>');
                        $.each(cities, function(i, city){
                            if(selected_city == city.id) $('#'+id).append('<option value="' + city.id + '" selected>' + city.city_name + '</option>');
                            else $('#'+id).append('<option value="' + city.id + '">' + city.city_name + '</option>');
                        });
                    },
                    error : function(data)
                    {
                        console.log('province_city.js#getCities function error: #line : 30');
                    }
                });


                return false;
            }

            $(document).on('change', '#state1', function (e) {
                getCities(this,"city1");
            });
            $(document).on('change', '#state2', function (e) {
                getCities(this,"city2");
            });
            $(document).on('change', '#state3', function (e) {
                getCities(this,"city3");
            });
            $(document).on('change', '#state4', function (e) {
                getCities(this,"city4");
            });
            $(document).on('change', '#state4', function (e) {
                getCities(this,"city4");
            });
            $(document).on('change', '#state5', function (e) {
                getCities(this,"city5");
            });
            $(document).on('change', '#city2', function (e) {
                getCities(this,"region2");
            });
            $(document).on('change', '#city4', function (e) {
                getCities(this,"region4");
            });
            $(document).on('change', '#city5', function (e) {
                getCities(this,"region5");
            });
        </script>
    @endsection
@endsection
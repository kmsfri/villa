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
                <li><a href="{{route('villas_based_category1',$category1->category_slug)}}" title="{{$category1->category_title}}"><img src="" alt="{{$category1->category_title}}">{{$category1->category_title}}</a></li>
            @endforeach
        </ul>
    @endif
    <!--start section search-->
    <section class="search">
        <div class="container">
            <!--h1.title با ویلایار خیلی راحت ویلاتو پیدا کن !-->
            <div class="box-search">

                <div class="userblog text-center" style="padding: 10px">
                    <img src="{{asset($user->avatar_dir)}}" style="border-radius: 50%;width: 100px;">

                    <p>{{$user->fullname}}</p>
                    <p>{{$user->blog_description}}</p>
                    <ul class="ul-social">
                        <li><a href="http://t.me/{{$user->telegram_link}}" target="_blank" title=""><img src="http://localhost/villa/villa/public/users/img/icon/icon035.png" alt=""><img class="img" src="http://localhost/villa/villa/public/users/img/icon/icon035.png" alt=""></a></li>
                        <li><a href="http://instagram.com/{{$user->instagram_link}}" target="_blank" title=""><img src="http://localhost/villa/villa/public/users/img/icon/icon036.png" alt=""><img class="img" src="http://localhost/villa/villa/public/users/img/icon/icon036.png" alt=""></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    <!--end section search-->

    <!--start section vila-->
    @include('user.web.common.villalist')
    <!--end section vila-->

    <!--start section tourism-->
    @include('user.web.common.contents-slider')
    <!--end section tourism-->

    <!--start modal-->
    <script>
        $(document).ready(function(){
            $(document).on('click', 'span#close_first_modal', function(){
                $('#filterModal').modal('toggle');
            });
        });
    </script>
    @include('user.web.common.filtermodal')

    @if( Session::has('errorcomment') )
        {!! Session::get('errorcomment') !!}

    @endif

@section('jsmap')
    <script>
        function getCities(th,id)
        {

            selected_city = $('#'+id).attr('data-selected') || null;
            $('#'+id).html('').fadeIn(800).append('<option value="0">لطفا کمی صبر کنید ...</option>');

            $.ajax({
                type: "POST",
                cache: false,
                url: '{{url('ajax/get_province_cities')}}',
                data: {r_id:$(th).val()},
                dataType : 'text',
                success: function(data)
                {
                    var cities = $.parseJSON(data);

                    $('#'+id).html('').fadeIn(800).append('<option value="0">انتخاب کنید</option>');
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
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
                <li><a href="{{route('villas_based_category1',$category1->category_slug)}}" title="{{$category1->category_title}}"><img src="{{asset($category1->image_dir)}}" width="30px" alt="{{$category1->category_title}}">{{$category1->category_title}}</a></li>
            @endforeach
        </ul>
    @endif

    <!--start section vila-->
    @include('user.web.common.villalist')
    <!--end section vila-->

    <!--start section tourism-->
    @include('user.web.common.contents-slider')
    <!--end section tourism-->
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
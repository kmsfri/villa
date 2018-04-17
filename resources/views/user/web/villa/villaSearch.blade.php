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
    @include('user.web.common.centersearchbox')
    @include('user.web.common.villalist')


@section('jsmap')
    <script>
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
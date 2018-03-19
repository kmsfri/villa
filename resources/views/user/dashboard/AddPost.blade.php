@extends('user.dashboard.master')
@section('main')


    <div class="header-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                    <ul class="ul-header">
                        <!-- <li><a class="login" href="" title="محمد قلعه نوئی">محمد قلعه نوئی</a></li> -->
                        <li><a class="record" href="" title="ثبت رایگان ملک">ثبت جاذبه گردشگری</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
        <li><a href="" title="پیشخوان">پیشخوان</a></li>
        <li><a href="" title="جاذبه های گردشگری">جاذبه های گردشگری</a></li>
        <li><a href="" title="افزودن جاذبه های گردشگری">افزودن جاذبه های گردشگری</a></li>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="post" action="{{route('addcontentaction')}}" enctype="multipart/form-data">
                    <input name="edit_id" value="@if(isset($content)) {{$content->id}} @endif">
                    {{csrf_field()}}
                    <div class="box-panel padding">
                        @if( Session::has('data') )
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('data') }}
                            </div>
                        @endif
                        <div class="header">
                            <h3 class="title-box">جزئیات برگه</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-form">
                                        <label for="files">آپلود تصاویر مطلب</label>
                                        <input id="files" type="file" name="image[]" multiple="multiple" required /><br>
                                        <output id="result" />
                                        @if ($errors->has('image.*')) <span class="help-block"><strong>{{ $errors->first('image.*') }}</strong></span> @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>* عنوان مطلب</label>
                                        <input class="form-control" type="text" value="{{ old('content_title',isset($content->content_title) ? $content->content_title : '') }}" name="content_title" required>
                                        @if ($errors->has('content_title')) <span class="help-block"><strong>{{ $errors->first('content_title') }}</strong></span> @endif
                                    </div>
                                    <div class="form-group">
                                        <label>* آدرس مطلب(url)</label>
                                        <input class="form-control" type="text" value="{{ old('content_slug',isset($content->content_slug) ? $content->content_slug : '') }}" name="content_slug" required>
                                        @if ($errors->has('content_slug')) <span class="help-block"><strong>{{ $errors->first('content_slug') }}</strong></span> @endif
                                    </div>
                                    <div class="form-group arrow">
                                        <label>استان</label>
                                        <select class="form-control" id="state" name="state" required>
                                            <option value="0">انتخاب استان</option>
                                            @if(count($states))
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->city_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('state')) <span class="help-block"><strong>{{ $errors->first('state') }}</strong></span> @endif
                                    </div>
                                    <div class="form-group arrow">
                                        <label>شهر</label>
                                        <select class="form-control" id="city" name="city" required>
                                            <option value="0">ابتدا شهر را انتخاب کنید</option>
                                        </select>
                                        @if ($errors->has('city')) <span class="help-block"><strong>{{ $errors->first('city') }}</strong></span> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">متن مطلب</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="cktext" rows="6" name="content_body" required>{{ old('content_body',isset($content->content_body) ? $content->content_body : '') }}</textarea>
                                        @if ($errors->has('content_body')) <span class="help-block"><strong>{{ $errors->first('content_body') }}</strong></span> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">تنظیمات مطلب</h3><br>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>* برچسب ها(کلمات کلیدی را با ویرگول جدا نمایید)</label>
                                        <input class="form-control" value="{{ old('content_tags',isset($content->content_tags) ? $content->content_tags : '') }}" type="text" name="content_tags" required>
                                        @if ($errors->has('content_tags')) <span class="help-block"><strong>{{ $errors->first('content_tags') }}</strong></span> @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>* ترتیب نمایش از بین {{$contentcount}} مطلب</label>
                                        <select class="form-control" name="content_order" required>

                                            <option value="1" selected>1</option>
                                            @for($i = 2;$i <= $contentcount;$i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        @if ($errors->has('content_order')) <span class="help-block"><strong>{{ $errors->first('content_order') }}</strong></span> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-panel">
                        <div class="header">
                            <h3 class="title-box">موقعیت مکانی اقامتگاه</h3>
                        </div>
                        <div class="data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>آدرس محل اقامتگاه</label>
                                    </div>
                                    <input type="hidden" value="" id="latitude" name="latitude">
                                    <input type="hidden" value="" id="longitude" name="longitude">
                                    <div id="map">
                                        <div id="map-container"></div>
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
    <script src="{{ asset('users/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('cktext');
    </script>
    <script type="text/javascript">
        window.onload = function(){

            //Check File API support
            if(window.File && window.FileList && window.FileReader)
            {
                var filesInput = document.getElementById("files");

                filesInput.addEventListener("change", function(event){

                    var files = event.target.files; //FileList object
                    var output = document.getElementById("result");
                    $( ".thumbnail" ).remove();
                    for(var i = 0; i< files.length; i++)
                    {
                        var file = files[i];

                        //Only pics
                        if(!file.type.match('image'))
                            continue;

                        var picReader = new FileReader();

                        picReader.addEventListener("load",function(event){

                            var picFile = event.target;

                            var div = document.createElement("div");

                            div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                "title='" + picFile.name + "'/>";

                            output.insertBefore(div,null);

                        });

                        //Read the image
                        picReader.readAsDataURL(file);
                    }

                });
            }
            else
            {
                console.log("Your browser does not support File API");
            }
        }
    </script>
    <script>
        function getCities(th)
        {

            selected_city = $('#city').attr('data-selected') || null;
            $('#city').html('').fadeIn(800).append('<option value="0">لطفا کمی صبر کنید ...</option>');

            $.ajax({
                type: "POST",
                cache: false,
                url: '{{url('ajax/get_province_cities')}}',
                data: {r_id:$(th).val()},
                dataType : 'text',
                success: function(data)
                {
                    var cities = $.parseJSON(data);

                    $('#city').html('').fadeIn(800).append('<option value="0">انتخاب شهر</option>');
                    $.each(cities, function(i, city){
                        if(selected_city == city.id) $('#city').append('<option value="' + city.id + '" selected>' + city.city_name + '</option>');
                        else $('#city').append('<option value="' + city.id + '">' + city.city_name + '</option>');
                    });
                },
                error : function(data)
                {
                    console.log('province_city.js#getCities function error: #line : 30');
                }
            });


            return false;
        }

        $(document).on('change', '#state', function (e) {
            getCities(this);
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&key=AIzaSyAUTOnItAcKwoEjTUA8nbIPjdOngcEpJV0"></script>
    <script type="text/javascript">

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map-container'), {
                center: {lat: 35.42323874580487, lng: 52.07075264355467 },
                zoom: 6,
                //disableDefaultUI: true,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                animation: google.maps.Animation.DROP,
            });
            var marker = new google.maps.Marker({
                position: {lat: 35.42323874580487, lng: 52.07075264355467 },
                map: map,
                icon: '{{asset("users/img/marker-map.png")}}',
                labelAnchor: new google.maps.Point(50, 0),
                draggable: true
            });
            google.maps.event.addListener(marker, "mouseup", function (event) {
                var latitude = this.position.lat();
                var longitude = this.position.lng();
                $('#latitude').val( this.position.lat() );
                $('#longitude').val( this.position.lng() );
            });


        }



        $( document ).ready(function() {
            initMap();
        });

    </script>

@endsection
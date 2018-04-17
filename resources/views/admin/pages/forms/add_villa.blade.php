@extends('admin.master-add')
@section('content_add_form')
    @if(session('cities'))
        @php
            $cities=session('cities');
        @endphp
    @endif
    @if(session('districts'))
        @php
            $districts=session('districts');
        @endphp
    @endif
    <input type="hidden" name="renter_user_id" value="{{ old('renter_user_id',isset($renter_user_id) ? $renter_user_id : '') }}">
    <div class="main-panel">
        <div class="box-panel padding">
            <div class="data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-form">
                            <input id="files" type="file" name="newImg[]" multiple="multiple" autocomplete="off" accept="image/jpg, image/jpeg, image/png" /><br>
                            <output id="result">
                                @if(isset($villa) && $villa!=Null)
                                    @foreach($villa->VillaImages()->get() as $cimg)
                                        <div>
                                            <img class="thumbnail" src="{{url($cimg->image_dir)}}">
                                            <input name="oldImg[]" type="hidden" value="{{$cimg->id}}">
                                            <a href="javascript:void()" onclick="$(this).closest('div').remove()" style="display: block">حذف</a>
                                        </div>
                                    @endforeach
                                @endif
                            </output>
                            @if ($errors->has('newImg.*')) <span class="help-block"><strong>{{ $errors->first('newImg.*') }}</strong></span> @endif
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>* عنوان آگهی ویلا</label>
                            <input class="form-control" type="text" value="{{ old('villa_title',isset($villa->villa_title) ? $villa->villa_title : '') }}" name="villa_title" required>
                            @if ($errors->has('villa_title')) <span class="help-block"><strong>{{ $errors->first('villa_title') }}</strong></span> @endif
                        </div>
                        <div class="form-group arrow">
                            <label>استان</label>
                            <select class="form-control" id="state" name="state" required autocomplete="off">
                                <option {{(!old('state', isset($villa->province) ? $villa->province : '')? 'selected' : '')}} value="" >انتخاب استان</option>
                                @foreach($states as $pr)
                                    <option @if(old('state', isset($villa->province) ? $villa->province : '')==$pr->id) selected @endif value="{{$pr->id}}" >{{$pr->city_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('state')) <span class="help-block"><strong>{{ $errors->first('state') }}</strong></span> @endif
                        </div>
                        <div class="form-group arrow">
                            <label>شهر</label>
                            <select class="form-control" id="city" name="city" required autocomplete="off">
                                <option {{(!old('city', isset($villa->city_id) ? \App\Models\City::find($villa->city_id)->province()->first()->id : '')? 'selected' : '')}} value="" disabled>شهر را انتخاب کنید</option>
                                @foreach($cities as $city)
                                    <option @if(old('city', isset($villa->city_id) ? $villa->city_id : '')==$city->id) selected @endif value="{{$city->id}}" >{{$city->city_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('city')) <span class="help-block"><strong>{{ $errors->first('city') }}</strong></span> @endif
                        </div>
                        <div class="form-group arrow">
                            <label>منطقه</label>
                            <select class="form-control" id="district" name="district" required autocomplete="off">
                                <option {{(!old('district', isset($villa->district) ? $villa->district : '')? 'selected' : '')}} value="" disabled>منطقه را انتخاب کنید</option>
                                @foreach($districts as $dst)
                                    <option @if(old('district', isset($villa->district) ? $villa->district : '')==$dst->id) selected @endif value="{{$dst->id}}" >{{$dst->city_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('district')) <span class="help-block"><strong>{{ $errors->first('district') }}</strong></span> @endif
                        </div>


                        <div class="form-group arrow">
                            <label>نوع ملک/ویلا</label>
                            <select class="form-control" id="villa_type_id" name="villa_type_id" required autocomplete="off">
                                <option {{(!old('villa_type_id', isset($villa->villa_type_id) ? $villa->villa_type_id : '')? 'selected' : '')}} value="" >انتخاب نوع ملک/ویلا</option>
                                @foreach($villaTypes as $VT)
                                    <option @if(old('villa_type_id', isset($villa->villa_type_id) ? $villa->villa_type_id : '')==$VT->id) selected @endif value="{{$VT->id}}" >{{$VT->villa_type_title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('villa_type_id')) <span class="help-block"><strong>{{ $errors->first('villa_type_id') }}</strong></span> @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>




        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">مشخصات کلی</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>* مساحت زمین</label>
                            <input name="land_area" placeholder="متر مربع" value="{{ old('land_area',isset($villa->land_area) ? $villa->land_area : '') }}" class="form-control" type="text">
                            @if ($errors->has('land_area')) <span class="help-block"><strong>{{ $errors->first('land_area') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>* مساحت ساختمان</label>
                            <input name="building_area" placeholder="متر مربع" value="{{ old('building_area',isset($villa->building_area) ? $villa->building_area : '') }}" class="form-control" type="text">
                            @if ($errors->has('building_area')) <span class="help-block"><strong>{{ $errors->first('building_area') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>زیربنا</label>
                            <input name="foundation_area" placeholder="متر مربع" value="{{ old('foundation_area',isset($villa->foundation_area) ? $villa->foundation_area : '') }}" class="form-control" type="text">
                            @if ($errors->has('foundation_area')) <span class="help-block"><strong>{{ $errors->first('foundation_area') }}</strong></span> @endif
                        </div>
                        <div class="form-group arrow">
                            <label>تعداد طبقه</label>
                            <select class="form-control" name="floor_count" required autocomplete="off">
                                <option selected="" {{(old('floor_count', isset($villa->floor_count) ? $villa->floor_count : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 10; $i++)
                                    <option {{(old('floor_count', isset($villa->floor_count) ? $villa->floor_count : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('floor_count')) <span class="help-block"><strong>{{ $errors->first('floor_count') }}</strong></span> @endif
                        </div>
                        <div class="form-group arrow">
                            <label>تعداد اتاق خواب</label>
                            <select class="form-control" name="bedroom_count" required autocomplete="off">
                                <option selected="" {{(old('bedroom_count', isset($villa->bedroom_count) ? $villa->bedroom_count : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 10; $i++)
                                    <option {{(old('bedroom_count', isset($villa->bedroom_count) ? $villa->bedroom_count : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('bedroom_count')) <span class="help-block"><strong>{{ $errors->first('bedroom_count') }}</strong></span> @endif
                        </div>
                        <div class="form-group arrow">
                            <label>تعداد تخت خواب</label>
                            <select class="form-control" name="bed_count" required autocomplete="off">
                                <option selected="" {{(old('bed_count', isset($villa->bed_count) ? $villa->bed_count : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 10; $i++)
                                    <option {{(old('bed_count', isset($villa->bed_count) ? $villa->bed_count : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('bed_count')) <span class="help-block"><strong>{{ $errors->first('bed_count') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>فاصله تا دریا ( ماشین )</label>
                            <input name="sea_distance_by_car" placeholder="ساعت / دقیقه" value="{{ old('sea_distance_by_car',isset($villa->sea_distance_by_car) ? $villa->sea_distance_by_car : '') }}" class="form-control" type="text">
                            @if ($errors->has('sea_distance_by_car')) <span class="help-block"><strong>{{ $errors->first('sea_distance_by_car') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>فاصله تا دریا ( پیاده )</label>
                            <input name="sea_distance_walking" placeholder="ساعت / دقیقه" value="{{ old('sea_distance_walking',isset($villa->sea_distance_walking) ? $villa->sea_distance_walking : '') }}" class="form-control" type="text">
                            @if ($errors->has('sea_distance_walking')) <span class="help-block"><strong>{{ $errors->first('sea_distance_walking') }}</strong></span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>نرخ اجاره روزانه</label>
                            <input name="rent_daily_price_from" placeholder="مبلغ به تومان" value="{{ old('rent_daily_price_from',isset($villa->rent_daily_price_from) ? $villa->rent_daily_price_from : '') }}" class="form-control" type="text">
                            @if ($errors->has('rent_daily_price_from')) <span class="help-block"><strong>{{ $errors->first('rent_daily_price_from') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>نرخ اجاره روزانه روزهای وسط هفته ( شنبه تا چهارشنبه )</label>
                            <input name="midweek_price" placeholder="مبلغ به تومان" value="{{ old('midweek_price',isset($villa->midweek_price) ? $villa->midweek_price : '') }}" class="form-control" type="text">
                            @if ($errors->has('midweek_price')) <span class="help-block"><strong>{{ $errors->first('midweek_price') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>نرخ اجاره روزانه روزهای آخر هفته (  چهارشنبه تا جمعه )</label>
                            <input name="lastweek_price" placeholder="مبلغ به تومان" value="{{ old('lastweek_price',isset($villa->lastweek_price) ? $villa->lastweek_price : '') }}" class="form-control" type="text">
                            @if ($errors->has('lastweek_price')) <span class="help-block"><strong>{{ $errors->first('lastweek_price') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>نرخ اجاره روزانه ایام پیک سال</label>
                            <input name="peaktime_price" placeholder="مبلغ به تومان" value="{{ old('peaktime_price',isset($villa->peaktime_price) ? $villa->peaktime_price : '') }}" class="form-control" type="text">
                            @if ($errors->has('peaktime_price')) <span class="help-block"><strong>{{ $errors->first('peaktime_price') }}</strong></span> @endif
                        </div>
                        <div class="form-group">
                            <label>توضیحات اجاره</label>
                            <textarea rows="9" class="form-control" name="price_description" placeholder="قیمت اعلام شده مربوط به روزهای عادی و تا سقف ظرفیت نرمال میباشد و قیمت در روز های آخر هفته، تعطیلات، مناسبت ها، ایام نوروز و یا نفرات بیش از ظرفیت نرمال، افزایش می یابد.">{{ old('price_description',isset($villa->price_description) ? Helpers::br2nl($villa->price_description) : '') }}</textarea>
                            @if ($errors->has('price_description'))<span class="help-block"><strong>{{ $errors->first('price_description') }}</strong></span>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">ظرفیت</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>ظرفیت نرمال</label>


                            <select class="form-control" name="standard_capacity" required autocomplete="off">
                                <option selected="" {{(old('standard_capacity', isset($villa->standard_capacity) ? $villa->standard_capacity : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 20; $i++)
                                    <option {{(old('standard_capacity', isset($villa->standard_capacity) ? $villa->standard_capacity : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('standard_capacity')) <span class="help-block"><strong>{{ $errors->first('standard_capacity') }}</strong></span> @endif


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>تعداد حمام</label>
                            <select class="form-control" name="bathroom_count" required autocomplete="off">
                                <option selected="" {{(old('bathroom_count', isset($villa->bathroom_count) ? $villa->bathroom_count : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 5; $i++)
                                    <option {{(old('bathroom_count', isset($villa->bathroom_count) ? $villa->bathroom_count : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('bathroom_count')) <span class="help-block"><strong>{{ $errors->first('bathroom_count') }}</strong></span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>حداکثر ظرفیت</label>


                            <select class="form-control" name="max_capacity" required autocomplete="off">
                                <option selected="" {{(old('max_capacity', isset($villa->max_capacity) ? $villa->max_capacity : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 5; $i++)
                                    <option {{(old('max_capacity', isset($villa->max_capacity) ? $villa->max_capacity : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('max_capacity')) <span class="help-block"><strong>{{ $errors->first('max_capacity') }}</strong></span> @endif

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group arrow">
                            <label>تعداد دستشویی</label>
                            <select class="form-control" name="wc_count" required autocomplete="off">
                                <option selected="" {{(old('wc_count', isset($villa->wc_count) ? $villa->wc_count : '')=='')?'selected':''}}> انتخاب کنید</option>
                                @for($i = 1;$i <= 5; $i++)
                                    <option {{(old('wc_count', isset($villa->wc_count) ? $villa->wc_count : '')==$i)?'selected':''}} value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('wc_count')) <span class="help-block"><strong>{{ $errors->first('wc_count') }}</strong></span> @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach($properties as $pr)
            <div class="box-panel">
                <div class="header">
                    <h3 class="title-box">{{$pr->prop_title}}</h3>
                </div>
                @if($pr->PropEnabledValues()->where('has_text_value',1)->count()>0)
                    @php
                        $class1='box-p';
                    @endphp
                @else
                    @php
                        $class1='data';
                    @endphp
                @endif
                <div class="{{$class1}}">

                        @php $counter1=1; $colorClassFlag=true; @endphp
                        @foreach($pr->PropEnabledValues()->get() as $propValue1)
                            @if($propValue1->has_text_value==1)

                            @if($counter1==1)
                            <div class="row {{($colorClassFlag)?'color':'' }} padding">
                                @if($colorClassFlag) @php $colorClassFlag=false; @endphp @else @php $colorClassFlag=true @endphp @endif
                            @endif
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="list__item">
                                                <label class="label--checkbox">
                                                    <input name="propCheck[{{$propValue1->id}}]" {{(isset($villa)&&$villa->Properties()->where('property_id',$propValue1->id)->count()>0)?'checked':''}} value="{{$propValue1->id}}" class="checkbox" type="checkbox">{{$propValue1->prop_title}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-8">
                                            <input name="propText[{{$propValue1->id}}]" class="form-control" type="text" value="{{(isset($villa)&&($VP=$villa->Properties()->withPivot(['text_value'])->where('property_id',$propValue1->id))->count()>0)?$VP->first()->pivot->text_value:''}}">
                                        </div>
                                    </div>
                                </div>
                            @if($counter1==2 || $pr->PropEnabledValues()->get()->last()->id==$propValue1->id)
                            </div>
                            @endif
                            @if($counter1>=2)
                                @php $counter1=1; @endphp
                            @else
                                @php $counter1+=1; @endphp
                            @endif



                            @else
                                @if(isset($villa))
                                @foreach($villa->AllSpecProperty($propValue1->id) as $oneSP)
                                <div class="col-md-6">
                                    <div class="form-group arrow">
                                        <label>{{$propValue1->prop_title}}</label>
                                        @if($propValue1->guide_text!=Null && $propValue1->guide_text!='')
                                        <button class="btn btn-group2" type="button" data-toggle="tooltip" data-placement="top" title="{{$propValue1->guide_text}}">؟</button>
                                        @endif

                                        <select  name='props[]' class='selectpicker form-control pull-right' autocomplete="off">
                                            <option  value="" >انتخاب کنید</option>
                                            @foreach($propValue1->PropEnabledValues()->get() as $prv)
                                                <option @if(old('props.'.$propValue1->id , (isset($villa)&&isset($oneSP->id)) ? $oneSP->id : '')==$prv->id) selected @endif value="{{$prv->id}}" >{{$prv->prop_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @if((isset($villa) && $villa->AllSpecProperty($propValue1->id)->count()>0 && $propValue1->multi_assign==1) || (!isset($villa) || (isset($villa)&&$villa->AllSpecProperty($propValue1->id)->count()==0)))
                                <div id="selectContainer{{$propValue1->id}}">
                                    <div id="selectInstance{{$propValue1->id}}">
                                        <div class="selectInstanceCol col-md-6">
                                            <div class="form-group arrow">
                                                <label>{{$propValue1->prop_title}}</label>
                                                @if($propValue1->guide_text!=Null && $propValue1->guide_text!='')
                                                    <button class="btn btn-group2" type="button" data-toggle="tooltip" data-placement="top" title="{{$propValue1->guide_text}}">؟</button>
                                                @endif
                                                <select  name='props[]' class='selectpicker form-control pull-right' autocomplete="off">
                                                    <option  value="" >انتخاب کنید</option>
                                                    @foreach($propValue1->PropEnabledValues()->get() as $prv)
                                                        <option value="{{$prv->id}}" >{{$prv->prop_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-12">
                                @if($propValue1->multi_assign==1)
                                    <span class="text-left"><a href="javascript:void" onclick="createNewInstance('selectInstance{{$propValue1->id}}','selectContainer{{$propValue1->id}}')" >افزودن {{$propValue1->prop_title}} جدید</a></span>
                                @endif
                                </div>
                                @endif

                            @endif
                        @endforeach
                        <div class="row padding">
                        <div class="col-md-12">
                            <div class="form-group">

                            <label>توضیحات {{$pr->prop_title}}:</label>
                            <textarea rows="5" class="form-control" name="propDesc[{{$pr->id}}]" placeholder="توضیحات اضافی {{$pr->prop_title}} در این قسمت">{{(isset($villa)&&($VP=$villa->Properties()->withPivot(['text_value'])->where('property_id',$pr->id))->count()>0)? Helpers::br2nl($VP->first()->pivot->text_value):''}}</textarea>
                            @if ($errors->has('propDesc'.$pr->id))<span class="help-block"><strong>{{ $errors->first('propDesc'.$pr->id) }}</strong></span>@endif
                            </div>
                        </div>
                        </div>


                </div>
            </div>
        @endforeach

        <script type="text/javascript">
            function createNewInstance(selectInstanceID,selectContainerID){
                html=$('#'+selectInstanceID).html();
                $('#'+selectContainerID).append(html);

            }
        </script>




        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">درباره اقامتگاه</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>متن توضیحات در مورد ویلا</label>
                            <textarea rows="5" class="form-control" name="villa_description" placeholder="توضیحات اضافی در این قسمت">{{ old('villa_description',isset($villa->villa_description) ? Helpers::br2nl($villa->villa_description) : '') }}</textarea>
                            @if ($errors->has('villa_description'))<span class="help-block"><strong>{{ $errors->first('villa_description') }}</strong></span>@endif
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
                            <textarea rows="2" class="form-control" name="villa_address" placeholder="آدرس">{{ old('villa_address',isset($villa->villa_address) ? Helpers::br2nl($villa->villa_address) : '') }}</textarea>
                            @if ($errors->has('villa_address'))<span class="help-block"><strong>{{ $errors->first('villa_address') }}</strong></span>@endif
                        </div>
                        <div id="map">
                            <input type="hidden" value="" id="latitude" name="latitude">
                            <input type="hidden" value="" id="longitude" name="longitude">
                            <div id="map">
                                <div id="map-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="box-panel">
            <div class="header">
                <h3 class="title-box">وضعیت</h3>
            </div>
            <div class="data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>وضعیت نهایی</label>

                            <select class="form-control" name="villa_status" required autocomplete="off">
                                <option {{(old('villa_status', isset($villa->villa_status) ? $villa->villa_status : '')==0)? 'selected':''}} value="0">تایید نشده</option>
                                <option {{(old('villa_status', isset($villa->villa_status) ? $villa->villa_status : '')==1)? 'selected':''}} value="1">تایید شده</option>
                            </select>
                            @if ($errors->has('villa_status')) <span class="help-block"><strong>{{ $errors->first('villa_status') }}</strong></span> @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>








    </div>
@stop
@section('jsCustom')
    <script type="text/javascript">
        window.onload = function(){

            //Check File API support
            if(window.File && window.FileList && window.FileReader)
            {
                var filesInput = document.getElementById("files");

                filesInput.addEventListener("change", function(event){



                    var files = event.target.files; //FileList object

                    var output = document.getElementById("result");
                    $( ".newImgThumb" ).remove();
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


                            div.innerHTML = "" +
                                "<img class='thumbnail newImgThumb' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>" +
                                "<span class='newImgThumb' style=\"display: block\">تصویر جدید</span>"
                            ;
                            $(output).append(div);

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
        function getCities(th,elementID,selectTitle)
        {

            selected_city = $('#'+elementID).attr('data-selected') || null;
            $('#'+elementID).html('').fadeIn(800).append('<option value="0">لطفا کمی صبر کنید ...</option>');

            $.ajax({
                type: "POST",
                cache: false,
                url: '{{url('ajax/get_province_cities')}}',
                data: {r_id:$(th).val()},
                dataType : 'text',
                success: function(data)
                {
                    var cities = $.parseJSON(data);

                    $('#'+elementID).html('').fadeIn(800).append('<option value="0">'+selectTitle+'</option>');
                    $.each(cities, function(i, city){
                        if(selected_city == city.id) $('#'+elementID).append('<option value="' + city.id + '" selected>' + city.city_name + '</option>');
                        else $('#'+elementID).append('<option value="' + city.id + '">' + city.city_name + '</option>');
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
            getCities(this,'city','انتخاب شهر');
        });
        $(document).on('change', '#city', function (e) {
            getCities(this,'district','انتخاب منطقه');
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
                position: {lat: {{(isset($villa->latitude) && ($villa->latitude!=Null && trim($villa->latitude)!=''))?$villa->latitude:'35.42323874580487'}}, lng: {{(isset($villa->latitude) && ($villa->longitude!=Null && trim($villa->longitude)!=''))?$villa->longitude:'52.07075264355467'}} },
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
@stop

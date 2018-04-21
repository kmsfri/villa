@if(count($villas))
    <section class="vila">
        <div class="container">
            <div class="row justify-content-sm-center">

                @foreach($villas as $villa)
                    <div class="col-sm-6 col-md-6 col-lg-3">

                        <article class="vila">
                            <figure><img src="{{asset($villa->VillaImages()->orderBy('image_order','ASC')->first()->image_dir)}}" alt="{{$villa->villa_title}}"/><a class="estate" href="{{Route('showvilla',$villa->villa_slug)}}" title="{{$villa->villa_title}}">مشاهده ملک</a>
                                @if($villa->is_special==1)
                                <span class="special">ویژه</span>
                                @endif
                                <!--<a class="heart" href=""><i class="fa fa-heart-o"></i></a>-->
                            </figure>
                            <div class="data">
                                <h3 class="title"><a href="{{Route('showvilla',$villa->villa_slug)}}" title="{{$villa->villa_title}}">{{$villa->villa_title}}</a></h3><span class="price">{{number_format($villa->rent_daily_price_from)}} تومان</span>
                                @php $city = $villa->Cities()->first(); @endphp
                                <p class="place customheight">{{\App\Models\City::find($city->parent_id)->city_name}} - {{$city->city_name}}</p>
                                <div class="my-rating-8 villalistrate {{$villa->id}}"></div><span class="number"><span>{{$villa->Comments()->where('comment_status','=',1)->count()}}</span></span>
                            </div>
                            <ul>
                                <li><img src="{{asset('users/img/icon/icon088.png')}}" alt=""><span>{{$villa->bed_count}} تخت خواب</span></li>
                                <li><img src="{{asset('users/img/icon/icon087.png')}}" alt=""><span>تا {{$villa->max_capacity}} مهمان</span></li>
                                <li><img src="{{asset('users/img/icon/icon086.png')}}" alt=""><span>{{$villa->bedroom_count}} اتاق خواب</span></li>
                                <li><img src="{{asset('users/img/icon/icon085.png')}}" alt=""><span>{{$villa->foundation_area}} متر زیربنا</span></li>
                            </ul>
                        </article>

                    </div>
                @endforeach


            </div>
            <div class="pagination" style="display:table;margin:0 auto;padding-top: 20px;padding-bottom: 20px;">{!! str_replace('/?', '?', $villas->render()) !!}</div>
            <div class="clearfix"></div>
        </div>
    </section>
    @else
    <p style="text-align: center;margin-top: 200px;margin-bottom: 200px">مطلبی یافت نشد</p>
@endif
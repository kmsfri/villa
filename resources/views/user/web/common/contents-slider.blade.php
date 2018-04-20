@if(count($contents))
    <section class="tourism">
        <div class="container">
            <div class="box-title">
                <h2 class="title"><img src="{{asset('users/img/icon/icon010.png')}}" alt="">جاذبه های گردشگری و توریستی</h2><a class="more" href="" title="مشاهده بیشتر">مشاهده بیشتر</a>
            </div>

            <div class="slider-tourism">
                @foreach($contents as $content)
                    <div class="item">
                        <article class="tourism">
                            @if($content->ContentImages()->first()!=Null)
                                <img src="{{asset('images/users/user-uploads/user-contents').'/'.$content->ContentImages()->orderBy('image_order','ASC')->first()->image_dir}}" alt="{{$content->content_title}}"/>
                            @else
                                <img src="{{asset('images').'/404.jpg'}}" alt="{{$content->content_title}}"/>
                            @endif
                            @php $city = $content->Cities()->first(); @endphp
                            <p class="place">{{\App\Models\City::find($city->parent_id)->city_name}} - {{$city->city_name}}</p>

                            <div class="link"><a href="" title="{{$content->content_title}}">{{$content->content_title}}</a></div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@else
    <p style="text-align: center;margin-top: 200px;margin-bottom: 200px">مطلبی یافت نشد</p>
@endif
<div class="col-md-5 col-lg-4 sticky-vila">
    <aside class="theiaStickySidebar">
        <div class="box-price d-none d-md-inline-block">
            <div class="header">
                <p class="title">نرخ اجاره روزانه از<span>(هر شب)</span></p><span>{{number_format($villa->rent_daily_price_from)}} تومان</span>
            </div>
            <div class="data">
                <div class="box-property"><img class="img-author" src="{{asset('users/img/img0012452.jpg')}}" alt="">
                    <p class="title-author">{{$user->fullname}}</p>
                    <p><img src="{{asset('users/img/icon/icon089.png')}}" alt="">{{$user->mobile_number}}</p>
                    <p><img src="{{asset('users/img/icon/icon090.png')}}" alt="">کدملک :<span>{{$villa->id}}</span></p>
                    <div class="clearfix"></div>
                </div>
                <p>هنگام تماس تلفنی، لطفاً به کد ملک {{$villa->id}} در ویلایار اشاره کنید تا سریع‌تر راهنمایی شوید. قبل از تماس، راهنمای معامله امن و قوانین را بخوانید</p>
                <ul class="ul">
                    <li><a href="tel://{{$user->mobile_number}}" title="">تماس با مالک<img src="{{asset('users/img/icon/icon091.png')}}" alt=""></a></li>
                    <li><a href="tg://resolve?domain={{$user->telegram_link}}" title="">ارسال پیام در تلگرام<img src="{{asset('users/img/icon/icon092.png')}}" alt=""></a></li>
                    <li><a href="sms://{{$user->mobile_number}}" title="">ارسال پیامک به مالک<img src="{{asset('users/img/icon/icon093.png')}}" alt=""></a></li>
                </ul>
            </div>
        </div>
        <div class="box-price d-none d-md-inline-block reserveform" style="width: 100%;">
            <form class="search reserve_form" method="post" action="{{route('reserve_request',$villa->id)}}">
                <input type="hidden" value="{{csrf_token()}}" class="reserve_token">
                <div class="form-group width">
                    <ul class="ul-date">
                        <li>
                            <p>از تاریخ</p>
                        </li>
                        <li>
                            <p>تا تاریخ</p>
                        </li>
                    </ul>
                    <div class="width">
                        <input class="form-control datepicker date_in" name="date_in" type="text" value="{{old('date_in')}}" placeholder="تاریخ ورود" required>
                        <input class="form-control datepicker date_out" name="date_out" type="text" value="{{old('date_out')}}" placeholder="تاریخ خروج" required>
                    </div>
                </div>
                <div class="form-group guest arrow">
                    <label>تعداد میهمانان</label>
                    <select class="custom-select pc" required="" name="pc">
                        <option value="">انتخاب تعداد نفرات</option>
                        @for($i=1;$i <= $villa->max_capacity;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div><span>   کودکان بیش از 2 سال ((یک نفر )) محسوب می شوند</span>
                <div class="form-group name">
                    <label>نام و نام خانوادگی</label>
                    <input class="form-control fullname" type="text" name="fullname" value="{{old('fullname')}}" placeholder="نام و نام خانوادگی" required>
                </div>
                <div class="form-group contact">
                    <label>شماره تماس</label>
                    <input class="form-control phone" type="tel" name="phone" value="{{old('phone')}}" placeholder="شماره تماس- مثال(0912000000)" required>
                </div>
                <button class="btn btn-form" type="button" onclick="send_reserve()" placeholder="ارسال درخواست رزرو ویلا">ارسال درخواست رزرو ویلا</button>
            </form>
        </div>
        <div class="box-aside text-center">
            <h3 class="title-center">اشتراک مطلب برای دوستان</h3>
            <ul class="ul-social">
                <li><a href="https://plus.google.com/share?url={{url()->current()}}" title=""><img src="{{asset('users/img/icon/icon033.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon033.png')}}" alt=""></a></li>
                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" title=""><img src="{{asset('users/img/icon/icon034.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon034.png')}}" alt=""></a></li>
                <li><a href="tg://msg_url?url={{url()->current()}}" title=""><img src="{{asset('users/img/icon/icon035.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon035.png')}}" alt=""></a></li>
                <li><a href="" title=""><img src="{{asset('users/img/icon/icon036.png')}}" alt=""><img class="img" src="{{asset('users/img/icon/icon036.png')}}" alt=""></a></li>
            </ul><a class="link-violation" href="" data-toggle="modal" data-target="#reportmodal" title="گزارش تخلف این مطلب"><img src="{{asset('users/img/icon/icon037.png')}}" alt="">گزارش تخلف این مطلب</a>
        </div>
        <ul class="ul-aside">
            <li><a href="" title=""><img src="{{asset('users/img/icon/icon038.png')}}" alt=""><span>کانال تلگرام ویلایار</span></a></li>
            <li><a href="" title=""><img src="{{asset('users/img/icon/icon039.png')}}" alt=""><span>اینستاگرام ویلایار</span></a></li>
        </ul>
    </aside>
</div>
<div class="modal fade" id="reportmodal" tabindex="-1" role="dialog" aria-labelledby="reportmodallabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="rpform">
                <input type="hidden" value="{{csrf_token()}}" class="rptoken">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">گزارش تخلف این مطلب</h5>
                    <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
                                {{csrf_field()}}
                                <textarea name="content_report" rows="5" maxlength="280" style="width: 100%" type="text" class="crp" placeholder="گزارش خود را شرح دهید" required></textarea>
                            @else
                                <p>برای ثبت گزارش باید وارد وبسایت شوید.</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
                        <button class="btn btn-primary" onclick="send_report()" type="button">ارسال</button>
                    @endif

                </div>
            </form>
        </div>
    </div>
</div>
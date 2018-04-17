<div class="col-md-5 col-lg-4 sticky-vila">
    <aside class="theiaStickySidebar">
        <div class="box-aside">
            <h2 class="title-aside">پربازدیدترین مطالب</h2>
            @if(count($mostvisitcontents))
                @foreach($mostvisitcontents as $mostvisitcontent)
                    <article class="article-aside">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <figure>
                                    @if($mostvisitcontent->ContentImages()->first()!=Null)
                                        <img src="{{asset('images/users/user-uploads/user-contents').'/'.$mostvisitcontent->ContentImages()->first()->image_dir}}" alt="{{$mostvisitcontent->content_title}}"/>
                                    @else
                                        <img src="{{asset('images').'/404.jpg'}}" alt="{{$mostvisitcontent->content_title}}"/>
                                    @endif
                                </figure>
                            </div>
                            <div class="col-8 col-md-8 no-p">
                                <div class="data">
                                    <h3><a class="title" href="" title="{{$mostvisitcontent->content_title}}">{{$mostvisitcontent->content_title}}</a></h3>
                                    <p>
                                        @if($mostvisitcontent->authorRenterUser()->first()!=Null)
                                        <img src="{{asset('images/users/user-uploads/user-pics').'/'.$mostvisitcontent->authorRenterUser()->first()->avatar_dir}}" alt="{{$mostvisitcontent->authorRenterUser()->first()->fullname}}"/>{{$mostvisitcontent->authorRenterUser()->first()->fullname}}
                                        @elseif($mostvisitcontent->authorAdminUser()->first()!=Null)
                                        <span>مدیر سایت</span>
                                        @else
                                        <span>بدون تصویر</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @endif
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
</div>
</div>
</section>
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
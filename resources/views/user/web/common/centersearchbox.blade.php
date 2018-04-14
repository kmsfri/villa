<section class="search">
    <div class="container">
        <!--h1.title با ویلایار خیلی راحت ویلاتو پیدا کن !-->
        <div class="box-search">
            <form class="search d-flex d-md-none">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group arrow">
                            <select class="custom-select" id="state3" required="">
                                <option value="0">همه استان ها</option>
                                @if(count($states))
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->city_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group arrow">
                            <select class="custom-select" id="city3" required="">
                                <option value="0">همه شهر ها</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group code">
                            <input class="form-control" type="text" placeholder="کد ملک">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group arrow">
                            <select class="custom-select" required="">
                                <option value="">بروز شده ها</option>
                                <option value="1">تهران</option>
                                <option value="2">اصفهان</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <form class="search d-md-flex d-none">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group arrow">
                            <label>استان</label>
                            <select class="custom-select" id="state4" required="">
                                <option value="0">همه استان ها</option>
                                @if(count($states))
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->city_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group arrow">
                            <label>شهر</label>
                            <select class="custom-select" id="city4" required="">
                                <option value="0">همه شهر ها</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group area arrow">
                            <label>منطقه / محله</label>
                            <select class="custom-select" id="region4" required="">
                                <option value="">منطقه مورد نظر</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group code">
                            <label>کد ملک</label>
                            <input class="form-control" type="text" placeholder="کد ملک را وارد نمایید">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group type arrow">
                            <label>نوع ملک / ویلا</label>
                            <select class="custom-select" required="">
                                <option value="">جنگلی</option>
                                <option value="1">جنگلی</option>
                                <option value="2">جنگلی</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group capacity arrow">
                            <label>ظرفیت نفرات</label>
                            <select class="custom-select" required="">
                                <option value="">تعداد نفر</option>
                                <option value="1">تعداد نفر</option>
                                <option value="2">تعداد نفر</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group number arrow">
                            <label>تعداد اتاق ها</label>
                            <select class="custom-select" required="">
                                <option value="">تعداد اتاق ها</option>
                                <option value="1">تعداد اتاق ها</option>
                                <option value="2">تعداد اتاق ها</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group rent arrow">
                            <label>اجاره بها هر شب تا</label>
                            <select class="custom-select" required="">
                                <option value="">انتخاب کنید</option>
                                <option value="1">اول هفته</option>
                                <option value="2">وسط هفته</option>
                                <option value="2">آخر هفته</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group rent">
                            <label>اجاره بها هر شب</label>
                            <input class="form-control" name="price" type="text" placeholder="" value="100.000 تومان">
                            <input type="hidden" name="price_to_search" value="100000">
                            <button class="button left" type="button" data-enevtsum="sum">+</button>
                            <button class="button" type="button" data-enevtsum="sub">-</button>

                            <script>
                                jQuery(document).ready(function(){

                                    (function(a){a.extend({persianNumbers:function(b){var g={0:"۰",1:"۱",2:"۲",3:"۳",4:"۴",5:"۵",6:"۶",7:"۷",8:"۸",9:"۹"};var d=(b+"").split("");var f=d.length;var c;for(var e=0;e<=f;e++){c=d[e];if(g[c]){d[e]=g[c]}}return d.join("")}})})(jQuery);
                                    jQuery(document).on('click', '[data-enevtsum]', function(){
                                        var typesum = jQuery(this).data('enevtsum');
                                        var thisvalue = jQuery("input[name=price]").val();
                                        var repl = parseInt(jQuery("input[name=price_to_search]").val());

                                        let mo = 100000;
                                        if(typesum ==="sub") {
                                            var newprice = parseInt(repl) - mo;
                                        } else {
                                            var newprice = parseInt(repl) + mo;
                                        }

                                        jQuery("input[name=price_to_search]").val(newprice);
                                        var parts = newprice.toString().split(".");
                                        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        var new_price =  jQuery.persianNumbers(parts.join(".")) + " تومان";

                                        jQuery("input[name=price]").val(new_price);
                                    });




                                });
                            </script>
                        </div>
                    </div>
                </div>
            </form>
            <div class="footer d-md-block d-none"><a class="link-filter" href="" data-toggle="modal" data-target="#filterModal" title="فیلتر ها">فیلتر ها
                    <!--a.link-filter(href='', title='بروز شده ترین ویلا ها') بروز شده ترین ویلا ها--></a>
                <div class="form-group arrow">
                    <select class="custom-select" required="">
                        <option value="">بروز شده ترین ویلا ها</option>
                        <option value="1">تهران</option>
                        <option value="2">تهران</option>
                        <option value="3">تهران</option>
                    </select>
                </div><a class="btn-search" href="" title="جستجو">جستجو کن</a>
                <!--.clearfix-->
            </div>
        </div>
    </div>
</section>
<div class="sticky-form d-none d-lg-block">
    <div class="container">
        <form class="search" method="get" action="{{route('search')}}">
            {{csrf_field()}}
            <input type="hidden" name="type" value="1">
            <div class="row">
                <div class="col-sm-6 col-md-2">
                    <div class="form-group arrow">
                        <select class="custom-select" id="state1" name="state" autocomplete="off">
                            <option {{(!old('state', isset($search->state) ? $search->state : '')? 'selected' : '')}} value="0" >همه استانها</option>
                            @foreach($states as $pr)
                                <option @if(old('state', isset($search->state) ? $search->state : '')==$pr->id) selected @endif value="{{$pr->id}}" >{{$pr->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group arrow">
                        <select class="custom-select" id="city1" name="city" autocomplete="off">
                            <option {{(!old('city', isset($search->city) ? \App\Models\City::find($search->city)->province()->first()->id : '')? 'selected' : '')}} value="" disabled>شهر را انتخاب کنید</option>
                            @foreach($cities as $city)
                                <option @if(old('city', isset($search->city) ? $search->city : '')==$city->id) selected @endif value="{{$city->id}}" >{{$city->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                        <input class="form-control" name="villa_code" type="text" placeholder="کد ملک" value="{{old('villa_code', isset($search->villa_code) ? $search->villa_code : '')}}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group rent">
                        <input class="form-control" name="price" type="text" placeholder="" value="100.000 تومان">
                        <input type="hidden" name="price_to_search" value="100000">
                        <button class="button left" type="button" data-enevtsum="sum">+</button>
                        <button class="button" type="button" data-enevtsum="sub">-</button>

                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button class="btn btn-form">جستجو کن</button>

                    <!-- <a class="link-filter" href="" title="فیلتر ها">فیلتر ها</a> -->
                </div>
            </div>
        </form>
    </div>
</div>
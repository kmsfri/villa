<div class="sticky-form d-none d-lg-block">
    <div class="container">
        <form class="search" method="get" action="{{route('search')}}">
            {{csrf_field()}}
            <input type="hidden" name="type" value="1">
            <div class="row">
                <div class="col-sm-6 col-md-2">
                    <div class="form-group arrow">
                        <select class="custom-select" name="state" id="state1" required="">
                            <option value="0">همه استان ها</option>
                            @if(count($states))
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->city_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group arrow">
                        <select class="custom-select" name="city" id="city1" required="">
                            <option value="0" selected>همه شهر ها</option>

                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="کد ملک ">
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
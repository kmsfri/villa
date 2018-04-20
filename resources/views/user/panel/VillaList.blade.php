@extends('user.panel.masterLists')
@section('tableBody')
    <thead>
    <tr>
        <th scope="col">کدملک</th>
        <th class="width" scope="col">عنوان آگهی</th>
        <th scope="col">نرخ اجاره بها</th>
        <th scope="col">بروزرسانی</th>
        <th scope="col">ویــژه</th>
        <th scope="col">درخواست</th>
        <th scope="col">آمار</th>
        <th scope="col">وضعیت</th>
        <th scope="col">ویرایش</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">
            <input class="form-control" type="text">
        </th>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>

        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
    </tr>
    @foreach($villas as $villa)
    <tr>
        <th class="number" scope="row">{{$villa->id}}</th>
        <td>
            <p class="text">{{$villa->villa_title}}</p>
        </td>
        <td>
            <input class="form-control rate" type="text" placeholder="{{$villa->rent_daily_price_from}} تومان">
        </td>
        <td><a class="update" href="{{($villa->updated==1)?'javascript:void':Route('updateVilla',$villa->id)}}">{{($villa->updated==1)?'بروز شده':'بروزرسانی'}}</a></td>
        <td><a @if($villa->is_special==0) data-toggle="modal" data-target="#specializeModal" onclick="$('#villa_id_to_specialize').val('{{$villa->id}}')" @endif class="special {{($villa->is_special==1)?'active':''}}" href="javascript:void">{{($villa->is_special==1)?'ویژه':'ویژه کن'}}</a></td>
        <td><span class="request">39</span></td>
        <td><img class="img" src="{{asset('images/icon097.png')}}"></td>
        <td>
            <p class="situation {{($villa->villa_status==1)?'active':''}}">{{($villa->villa_status==1)?'تایید شده':'تایید نشده'}}</p>
        </td>
        <td><a href="{{Route('editVillaForm',$villa->id)}}"><img class="img2" src="{{asset('images/icon098.png')}}"></a></td>
    </tr>
    @endforeach
    </tbody>

    <div class="modal fade" id="specializeModal" tabindex="-1" role="dialog" aria-labelledby="specializeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویژه کردن آگهی</h5>
                        <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                    </div>

                    <div class="modal-body">
                        <form id="chooseSpecializeTariffFrm" method="POST" action="{{Route('specializeVilla')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="villa_id_to_specialize" id="villa_id_to_specialize" value="" autocomplete="off" required>
                                <div class="row">
                                    <div class="col-sm-12">
                                        یکی از تعرفه های زیر را انتخاب کنید.
                                    </div>
                                </div>
                            <div class="row">
                                @foreach($tariffs as $tariff)
                                    <div class="col-md-4">
                                        <p>
                                        <h5><input type="radio" class="radio" name="tariffID" value="{{$tariff->id}}" required>{{$tariff->tariff_title}}</h5>
                                        <span>مدت زمان: {{$tariff->tariff_duration}} روز</span></br>
                                        <span>هزینه: {{$tariff->tariff_price}}تومان</span></br>
                                        <span>امتیاز مورد نیاز: {{$tariff->tariff_needed_points}}</span></br>
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>نحوه پرداخت</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input required type="radio" class="radio" name="payType" value="0">درگاه پرداخت</br>
                                        <input required type="radio" class="radio" name="payType" value="1">پرداخت از امتیازات</br>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button form="chooseSpecializeTariffFrm" class="btn btn-primary" type="submit">انجام</button>
                            </div>




                        </form>

                    </div>

            </div>
        </div>
    </div>


@endsection
@section('pagination')
    <div class="pagination pull-left">{!! str_replace('/?', '?', $villas->render()) !!}</div>
@endsection
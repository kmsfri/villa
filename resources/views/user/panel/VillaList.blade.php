@extends('user.panel.masterLists')
@section('tableBody')
    <thead>
    <tr>
        <th scope="col">کدملک</th>
        <th class="width" scope="col">عنوان آگهی</th>
        <th scope="col">نرخ اجاره بها</th>
        <th scope="col">بروزرسانی</th>
        <th scope="col">ویــژه</th>
        <th scope="col">بروزرسانی</th>
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
        <td><a class="update" href="" title="بروزرسانی">بروزرسانی</a></td>
        <td><a class="special" href="">ویژه کن</a></td>
        <td><p class="text-update">بروز نشده</p></td>
        <td><span class="request">39</span></td>
        <td><img class="img" src="{{asset('images/icon097.png')}}"></td>
        <td>
            <p class="situation {{($villa->villa_status==1)?'active':''}}">{{($villa->villa_status==1)?'تایید شده':'تایید نشده'}}</p>
        </td>
        <td><a href="{{Route('editVillaForm',$villa->id)}}"><img class="img2" src="{{asset('images/icon098.png')}}"></a></td>
    </tr>
    @endforeach
    </tbody>

@endsection
@section('pagination')
    <div class="pagination pull-left">{!! str_replace('/?', '?', $villas->render()) !!}</div>
@endsection
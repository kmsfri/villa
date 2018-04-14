@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">عنوان</td>
        <td class="text-center">زمان</td>
        <td class="text-center">قیمت</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>

    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($tariffs as $trf)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$trf->id}}" type="checkbox">
            </td>
            <td class="text-center">
                    {{$c}} @php $c++; @endphp
            </td>
            <td class="text-center">
                    {{$trf->tariff_title}}
            </td>
            <td class="text-center">
                    {{$trf->tariff_duration}} روز
            </td>
            <td class="text-center">
                {{$trf->tariff_price}} تومان
            </td>
            <td class="text-center">
                {{($trf->tariff_status==1)?'فعل':'غیرفعال'}}
            </td>
            <td class="text-center">
                <a href="{{Route('editTariff',$trf->id)}}" data-toggle="tooltip" title="ویرایش تعرفه">
                    ویرایش تعرفه
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
@stop
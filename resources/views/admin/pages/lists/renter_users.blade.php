@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">شماره موبایل</td>
        <td class="text-center">نام کامل</td>
        <td class="text-center">لینک صفحه شخصی</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>
    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($users as $u)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$u->id}}" type="checkbox">
            </td>
            <td class="text-center">
                    {{$c}} @php $c++; @endphp
            </td>
            <td class="text-center">
                {{$u->mobile_number}}
            </td>
            <td class="text-center">
                {{($u->fullname!=Null)?$u->fullname:'-'}}
            </td>
            <td class="text-center">
                @if($u->profile_slug!=Null)
                    <a href="{{url($u->profile_slug)}}" target="_blank">
                        {{$u->profile_slug}}
                    </a>
                @else
                    -
                @endif
            </td>

            <td class="text-center">
                {{($u->user_status==1)?'فعال':'غیرفعال'}}
            </td>
            <td class="text-center">
                <a href="{{url(Route('edit_renter_form',$u->id))}}" data-toggle="tooltip" title="ویرایش کاربر">
                    ویرایش کاربر
                </a>|
                <a href="{{url(Route('adminShowVillaList',$u->id))}}" data-toggle="tooltip" title="ویلاها">
                    ویلاها
                </a>|
                <a href="{{url(Route('adminAddVillaForm',$u->id))}}" data-toggle="tooltip" title="افزودن ویلا">
                    افزودن ویلا
                </a>|
                <a href="{{url(Route('adminTicketList',$u->id))}}" data-toggle="tooltip" title="افزودن ویلا">
                    تیکتها
                </a>


            </td>
        </tr>
    @endforeach
    </tbody>
@stop
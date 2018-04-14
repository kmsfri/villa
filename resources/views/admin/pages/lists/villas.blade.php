@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">عنوان</td>
        <td class="text-center">ثبت کننده</td>
        <td class="text-center">لینک صفحه شخصی</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>
    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($villas as $v)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$v->id}}" type="checkbox">
            </td>
            <td class="text-center">
                {{$c}} @php $c++; @endphp
            </td>
            <td class="text-center">
                {{$v->villa_title}}
            </td>
            <td class="text-center">
                {{$v->RenterUser()->first()->mobile_number}}
            </td>
            <td class="text-center">
                @if($v->villa_slug!=Null)
                    <a href="{{url($v->villa_slug)}}" target="_blank">
                        {{$v->villa_slug}}
                    </a>
                @else
                    -
                @endif
            </td>

            <td class="text-center">
                {{($v->villa_status==1)?'تایید شده':'تایید نشده'}}
            </td>
            <td class="text-center">
                <a href="{{url(Route('adminEditVillaForm',$v->id))}}" data-toggle="tooltip" title="ویرایش ویلا">
                    ویرایش
                </a>|<a href="{{url(Route('adminEditVillaCategory',$v->id))}}" data-toggle="tooltip" title="ویرایش دسته بندیها">
                    دسته بندیها
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
@stop
@section('paginationContainer')
    {{ $villas->links() }}
@stop
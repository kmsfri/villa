@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">{{($parent_id==Null)?'عنوان خصوصیت':'مقدار خصوصیت'}}</td>
        <td class="text-center">مقدار</td>
        <td class="text-center">وضعیت</td>
        <td class="text-center">عملیات</td>
    </tr>
    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($properties as $prop)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$prop->id}}" type="checkbox">
            </td>
            <td class="text-center">
                {{$c}} @php $c++; @endphp
            </td>
            <td class="text-center">
            @if($parent_id==Null && $prop->has_text_value==0)
                <a href="{{ url(Route('propertiesList',$prop->id))}}">
            @endif
                    {{$prop->prop_title}}
            @if($parent_id==Null && $prop->has_text_value==0)
                </a>
            @endif
            </td>
            <td class="text-center">
                {{($prop->has_text_value==1)?'متنی':'استاتیک'}}
            </td>
            <td class="text-center">
                {{($prop->prop_status==1)?'فعال':'غیرفعال'}}
            </td>
            <td class="text-center">
                <a href="{{url(Route('editPropertyForm',$prop->id))}}">ویرایش</a>
            </td>
        </tr>
    @endforeach
    </tbody>

@stop

@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-left">
            <center>
                ردیف
            </center>
        </td>
        <td class="text-left">
            <center>
                عنوان
            </center>
        </td>
        <td class="text-right">
            <center>
                وضعیت
            </center>
        </td>
        <td class="text-right">
            <center>
                عملیات
            </center>
        </td>

    </tr>

    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($links as $link)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$link->id}}" type="checkbox">
            </td>
            <td class="text-center">
                    {{$c}} @php $c++; @endphp
            </td>
            <td class="text-center">
                    @if($canHasSubCategory)<a href="{{ url(Route('footerLink_list',$link->id))}}">@endif
                        {{$link->link_title}}
                    @if($canHasSubCategory==Null)</a>@endif
            </td>
            <td class="text-center">
                    {{($link->link_status==1)?'فعال':'غیرفعال'}}
            </td>

            <td class="text-center">
                <a href="{{Route(  ((isset($type) && $type='menuLinks')?'edit_menuLink_form':'edit_footerLink_form'),$link->id)}}">
                    ویرایش
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>

@stop
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
    @foreach($categories as $ctg)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$ctg->id}}" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    {{$c}} @php $c++; @endphp
                </center>
            </td>
            <td class="text-center">
                <center>
                    @if($canHasSubCategory)<a href="{{ url(Route('categories3-list',$ctg->id))}}">@endif
                            {{$ctg->category_title}}
                    @if($canHasSubCategory==Null)</a>@endif


                </center>
            </td>
            <td class="text-center">
                <center>
                    @if($ctg->category_status==1)
                        فعال
                    @else
                        غیر فعال
                    @endif
                </center>
            </td>

            <td class="text-center">
                <a href="{{url(Route('edit-category3-form',$ctg->id))}}">
                    ویرایش
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>

@stop
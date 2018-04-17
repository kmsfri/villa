@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-center">ردیف</td>
        <td class="text-center">عنوان</td>
        <td class="text-center">عملیات</td>
    </tr>

    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($villaTypes as $vt)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$vt->id}}" type="checkbox">
            </td>
            <td class="text-center">
                {{$c}} @php $c++; @endphp
            </td>
            <td class="text-center">
                {{$vt->villa_type_title}}
            </td>
            <td class="text-center">
                <a href="{{Route('editVillaType',$vt->id)}}" data-toggle="tooltip" title="ویرایش نوع ویلا">
                    ویرایش نوع ویلا
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
@stop
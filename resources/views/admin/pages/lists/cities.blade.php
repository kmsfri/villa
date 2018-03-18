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
                نام
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
    @foreach($cities as $city)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$city->id}}" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    {{$c}} @php $c++; @endphp
                </center>
            </td>
            <td class="text-center">
                <center>
                    @if($canHasSubCity)
                        <a href="{{ url(Route('cities-list',$city->id))}}">
                    @endif
                            {{$city->city_name}}
                    @if($canHasSubCity==Null)
                        </a>
                    @endif


                </center>
            </td>
            <td class="text-center">
                <center>
                    @if($city->city_status==1)
                        فعال
                    @else
                        غیر فعال
                    @endif
                </center>
            </td>

            <td class="text-center">
                <a href="{{url(Route('edit-city-form',$city->id))}}">
                    ویرایش
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>

@stop
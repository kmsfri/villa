@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <td style="width: 1px;" class="text-center"></td>
        <td class="text-left">
            <center>
                کد مطلب
            </center>
        </td>
        <td class="text-left">
            <center>
عنوان مطلب
            </center>
        </td>
        <td class="text-right">
            <center>
                شهر
            </center>
        </td>
        <td class="text-right">
            <center>
                تعداد نظرات
            </center>
        </td>
        <td class="text-right">
            <center>
                امتیاز
            </center>
        </td>
        <td class="text-right">
            <center>
                بازدید
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
        <td class="text-right">
            <center>
                تاریخ انتشار
            </center>
        </td>
        <td class="text-right">
            <center>
                آخرین ویرایش
            </center>
        </td>

    </tr>

    </thead>
    <tbody>
    @foreach($contents as $content)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$content->id}}" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    {{$content->id}}
                </center>
            </td>
            <td class="text-center">
                <p class="text">{{$content->content_title}}</p>
                @if($content->content_status != 0)
                    <a href="#" class="btn btn-bloglink">لینک مطلب</a>
                @endif
            </td>
            <td class="text-center">
                <p class="text">{{($content->Cities()->first()!=Null)?$content->Cities()->first()->city_name:'-'}}</p>
            </td>

            <td class="text-center">
                <p class="text">{{$content->RenterUserComments()->count()}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{$content->RenterUserScores()->count()}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{$content->view_count}}</p>
            </td>

            <td class="text-center">
            @if($content->content_status != 1)
                <p class="situation">تایید نشده</p>
            @else
                <p class="situation active">تایید شده</p>
            @endif
            </td>

            <td class="text-center">
                <a href="{{route('adminEditContentForm',$content->id)}}" data-toggle="tooltip" title="ویرایش"><i class="fa fa-pencil"></i></a>
                @if($content->show_in_body != 0)
                    <a href="{{route('adminShowinBody',$content->id)}}" data-toggle="tooltip" title="نمایش در بالای بلاگ"><i class="fa fa-eye"></i></a>
                @else
                    <a href="{{route('adminShowinBody',$content->id)}}" data-toggle="tooltip" title="عدم نمایش در بالای بلاگ"><i class="fa fa-eye-slash"></i></a>
                @endif
            </td>

            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($content->created_at,true)}}<br>{{$content->created_at->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($content->updated_at,true)}}<br>{{$content->updated_at->format('H:i:s')}}</p>
            </td>
        </tr>
    @endforeach
    </tbody>

@stop
@section('paginationContainer')
    {{ $contents->links() }}
@stop

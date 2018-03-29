@extends('user.panel.masterLists')
@section('tableBody')
<thead>
<tr>
    <th scope="col">کد مطلب</th>
    <th scope="col">عنوان مطلب</th>
    <th scope="col">شهر</th>
    <th scope="col">تعداد نظرات</th>
    <th scope="col">امتیاز تخصیص یافته</th>
    <th scope="col">تعداد بازدید</th>
    <th scope="col">وضعیت</th>
    <th scope="col">عملیات</th>
    <th scope="col">تاریخ انتشار</th>
    <th scope="col">آخرین ویرایش</th>
</tr>
</thead>
<tbody>
@if(count($contents))
    @foreach($contents as $content)
        <tr>
            <th class="number" scope="row">{{$content->id}}</th>
            <td>
                <p class="text">{{$content->content_title}}</p>
                @if($content->content_status != 0)
                    <a href="#" class="btn btn-bloglink">لینک مطلب</a>
                @endif
            </td>
            <td><p class="text">{{$content->Cities()->first()->city_name}}</p></td>
            <td><p class="text">{{$content->RenterUserComments()->count()}}</p></td>
            <td><p class="text">{{$content->RenterUserScores()->count()}}</p></td>
            <td><p class="text">{{$content->view_count}}</p></td>
            <td>
                @if($content->content_status != 1)
                    <p class="situation">تایید نشده</p>
                @else
                    <p class="situation active">تایید شده</p>
                @endif
            </td>
            <td>
                <a href="{{route('editcontent',$content->id)}}" data-toggle="tooltip" title="ویرایش"><i class="fa fa-pencil"></i></a>
                @if($content->show_in_body != 0)
                    <a href="{{route('showinbody',$content->id)}}" onclick="confirmaction();" data-toggle="tooltip" title="عدم نمایش در بالای بلاگ"><i class="fa fa-eye-slash"></i></a>
                @else
                    <a href="{{route('showinbody',$content->id)}}" onclick="confirmaction();" data-toggle="tooltip" title="نمایش در بالای بلاگ"><i class="fa fa-eye"></i></a>
                @endif
                <br>
                <a href="#" data-toggle="tooltip" title="درخواست حذف"><i class="fa fa-trash"></i></a>
                @if($content->is_draft != 0)
                    <a href="{{route('draft',$content->id)}}" onclick="confirmaction();" data-toggle="tooltip" title="وضعیت:پیش نویس"><i class="fa fa-sticky-note"></i></a>
                @else
                    <a href="{{route('draft',$content->id)}}" onclick="confirmaction();" data-toggle="tooltip" title="وضعیت:نهایی"><i class="fa fa-check"></i></a>
                @endif
            </td>
            <td>
                <p class="text">{{Helpers::convert_date_g_to_j($content->created_at,true)}}<br>{{$content->created_at->format('H:i:s')}}</p>
            </td>
            <td><p class="text">{{Helpers::convert_date_g_to_j($content->updated_at,true)}}<br>{{$content->updated_at->format('H:i:s')}}</p></td>
        </tr>
    @endforeach
@endif
</tbody>
@endsection
@section('pagination')
    <div class="pagination pull-left">{!! str_replace('/?', '?', $contents->render()) !!}</div>
@endsection
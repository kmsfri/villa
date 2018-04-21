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
                </a>|
                <a href="{{url(Route('adminEditVillaCategory',$v->id))}}" data-toggle="tooltip" title="ویرایش دسته بندیها">
                    دسته بندیها
                </a>|
                <a href="{{url(Route('adminReportList',$v->id))}}" data-toggle="tooltip" title="گزارش تخلف">
                    گزارش تخلف
                </a>|
                <a href="{{url(Route('adminVillaCommentList',$v->id))}}" data-toggle="tooltip" title="نظرات">
                    نظرات
                </a>
                |
                <a data-toggle="modal" data-target="#deleteAndTicketModal" onclick="$('#villa_id_to_deleteAndTicket').val('{{$v->id}}'); $('#deleteAndTicketVillaTitle').html('{{$v->villa_title}}'); " href="javascript:void" data-toggle="tooltip" title="حذف و ارسال تیکت برای کاربر">
                    حذف و ارسال پیام
                </a>

            </td>
        </tr>
    @endforeach
    </tbody>


    <div id="deleteAndTicketModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">حذف ویلا و ارسال پیام برای کاربر</h4>
                </div>
                <div class="modal-body">
                    <h4>عنوان ویلا: <span id="deleteAndTicketVillaTitle"></span></h4>

                    <form id="deleteAndTicketFrm" method="POST" action="{{Route('adminDoVillaDeleteAndTicket')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="villa_id_to_deleteAndTicket" id="villa_id_to_deleteAndTicket" value="" autocomplete="off" required>
                        <textarea rows="5" class="form-control" name="villaDeletionTicketMessage" placeholder="پیام خود را اینجا بنویسید"></textarea>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="submit" form="deleteAndTicketFrm" class="btn btn-danger">حذف ویلا و ارسال پیام</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">لغو</button>
                </div>
            </div>

        </div>
    </div>


@stop
@section('paginationContainer')
    {{ $villas->links() }}
@stop
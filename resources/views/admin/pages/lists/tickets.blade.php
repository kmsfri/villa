@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <th style="width: 1px;" class="text-center"></th>
        <th scope="col" class="text-center">کد تیکت</th>
        <th scope="col" class="text-center">تاریخ ایجاد تیکت</th>
        <th scope="col" class="text-center">تاریخ بروزرسانی</th>
        <th scope="col" class="text-center">وضعیت</th>
        <th scope="col" class="text-center">عملیات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $tc)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$tc->id}}" type="checkbox">
            </td>
            <th class="number text-center" scope="row">{{$tc->id}}</th>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($tc->created_at,true)}} - {{$tc->created_at->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($tc->updated_at,true)}} - {{$tc->updated_at->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="situation {{($tc->ticket_status==0)?'active':''}}">
                    {{($tc->ticket_status==0)?'باز':'بسته شده'}}
                </p>
            </td>
            <td class="text-center"><a href="{{Route('adminTicketMessages',$tc->id)}}">مشاهده</a></td>
        </tr>
    @endforeach
    </tbody>
@stop
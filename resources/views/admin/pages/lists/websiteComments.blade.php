@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <th style="width: 1px;" class="text-center"></th>
        <th scope="col" class="text-center">نظر دهنده</th>
        <th scope="col" class="text-center">تاریخ ثبت</th>
        <th scope="col" class="text-center">تاریخ بروزرسانی</th>
        <th scope="col" class="text-center">وضعیت</th>
        <th scope="col" class="text-center">عملیات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comments as $cm)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$cm->id}}" type="checkbox">
            </td>

            <td class="text-center">
                <p class="text">{{isset($cm->mobile_number)?$cm->mobile_number:$cm->WritenBy()->first()->mobile_number}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($cm->created_at,true)}} - {{\Carbon\Carbon::parse($cm->created_at)->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($cm->updated_at,true)}} - {{\Carbon\Carbon::parse($cm->updated_at)->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="situation {{($cm->comment_status==0)?'active':''}}">
                    @php
                        $cm_status=[
                            0=>'جدید',
                            1=>'بررسی شده',
                            2=>'پذیرفته شده',
                            3=>'رد شده',
                        ];
                    @endphp
                    {{$cm_status[$cm->comment_status]}}
                </p>
            </td>
            <td class="text-center"><a href="{{Route('editWebsiteComment',$cm->id)}}">مشاهده</a></td>
        </tr>
    @endforeach
    </tbody>
@stop
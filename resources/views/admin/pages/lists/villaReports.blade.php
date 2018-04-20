@extends('admin.master-lists')
@section('content_list')
    <thead>
    <tr>
        <th style="width: 1px;" class="text-center"></th>
        <th scope="col" class="text-center">گزارش دهنده</th>
        <th scope="col" class="text-center">کد ویلا</th>
        <th scope="col" class="text-center">تاریخ ثبت</th>
        <th scope="col" class="text-center">تاریخ بروزرسانی</th>
        <th scope="col" class="text-center">وضعیت</th>
        <th scope="col" class="text-center">عملیات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $rp)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$rp->id}}" type="checkbox">
            </td>

            <td class="text-center">
                <p class="text">{{isset($rp->mobile_number)?$rp->mobile_number:$rp->RenterUser()->first()->mobile_number}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{$rp->villa_id}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($rp->created_at,true)}} - {{\Carbon\Carbon::parse($rp->created_at)->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="text">{{Helpers::convert_date_g_to_j($rp->updated_at,true)}} - {{\Carbon\Carbon::parse($rp->updated_at)->format('H:i:s')}}</p>
            </td>
            <td class="text-center">
                <p class="situation {{($rp->report_status==0)?'active':''}}">
                    @php
                        $rp_status=[
                            0=>'جدید',
                            1=>'بررسی شده',
                            2=>'پذیرفته شده',
                            3=>'رد شده',
                        ];
                    @endphp
                    {{$rp_status[$rp->report_status]}}
                </p>
            </td>
            <td class="text-center"><a href="{{Route((isset($reportType) && $reportType=='content')?'editContentReport':'editReport',$rp->id)}}">مشاهده</a></td>
        </tr>
    @endforeach
    </tbody>
@stop
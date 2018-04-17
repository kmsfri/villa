@extends('user.panel.masterLists')
@section('tableBody')
    <thead>
    <tr>
        <th scope="col">کد تیکت</th>
        <th scope="col">تاریخ ایجاد تیکت</th>
        <th scope="col">تاریخ بروزرسانی</th>
        <th scope="col">وضعیت</th>
        <th scope="col">عملیات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $tc)
        <tr>
            <th class="number" scope="row">{{$tc->id}}</th>
            <td>
                <p class="text">{{Helpers::convert_date_g_to_j($tc->created_at,true)}} - {{$tc->created_at->format('H:i:s')}}</p>
            </td>
            <td>
                <p class="text">{{Helpers::convert_date_g_to_j($tc->updated_at,true)}} - {{$tc->updated_at->format('H:i:s')}}</p>
            </td>
            <td>
                <p class="situation {{($tc->ticket_status==0)?'active':''}}">
                    {{($tc->ticket_status==0)?'باز':'بسته شده'}}
                </p>
            </td>
            <td><a href="{{Route('ticketMessages',$tc->id)}}">مشاهده</a></td>
        </tr>
    @endforeach
    </tbody>

@endsection
@section('pagination')
    <div class="pagination pull-left">{!! str_replace('/?', '?', $tickets->render()) !!}</div>
@endsection
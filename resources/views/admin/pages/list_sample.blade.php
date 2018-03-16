@extends('admin.master-lists')
@section('content_list')
    <thead>
        <tr>
            <td style="width: 1px;" class="text-center"></td>
            <td class="text-left"><center>ردیف</center></td>
            <td class="text-left"><center>نام کاربری</center></td>
            <td class="text-right"><center>نام و نام خانوادگی</center></td>
            <td class="text-right"><center>وضعیت</center></td>
            <td class="text-right"><center>عملیات</center></td>
        </tr>
    </thead>
    <tbody>
    @php $c=1; @endphp
    @foreach($admins as $u)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$u->id}}" type="checkbox">
            </td>
            <td class="text-center"><center>
                    {{$c}} @php $c++; @endphp
            </center></td>
            <td class="text-center"><center>
                    {{$u->user_name}}
            </center></td>
            <td class="text-center"><center>
                    {{$u->user_title}}
            </center></td>
            <td class="text-center"><center>
                    @if($u->user_status==1)
                        فعال
                    @else
                        غیر فعال
                    @endif
            </center></td>
            <td class="text-center">
                <a href="{{url('admin/user/admin/edit/'.$u->id)}}" data-toggle="tooltip" title="ویرایش کاربر">
                    ویرایش کاربر
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
@stop
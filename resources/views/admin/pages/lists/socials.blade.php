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
                تصویر
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
    @foreach($socials as $s)
        <tr>
            <td class="text-center">
                <input form="delForm" name="remove_val[]" value="{{$s->id}}" type="checkbox">
            </td>
            <td class="text-center">
                <center>
                    {{$c}} @php $c++; @endphp
                </center>
            </td>
            <td class="text-center">
                <center>
                    @if(file_exists(public_path().$s->img_dir))
                        <img style="margin-top:1px;max-height:34px;" src="{{url($s->img_dir)}}">
                    @else
                        <span>بدون تصویر</span>
                    @endif
                </center>
            </td>


            <td class="text-center">
                <center>
                    @if($s->s_status==1)
                        فعال
                    @else
                        غیر فعال
                    @endif
                </center>
            </td>

            <td class="text-center">
                <a href="{{Route('editSocialForm',$s->id)}}">
                    ویرایش
                </a>
            </td>

        </tr>
    @endforeach
    </tbody>
@stop
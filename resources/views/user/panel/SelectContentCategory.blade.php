@extends('user.panel.masterForms')
@section('formBody')
@foreach($masterCtgs as $mctg)
<div class="box-panel">
    <div class="header">
        @php
            $hasSubMenu=false;
            if($mctg->SubCategory3()->count()>0)$hasSubMenu=true;
        @endphp

        <input {{($content->Categories3()->find($mctg->id)!=Null)?'checked':''}} class="checkbox" {{($hasSubMenu)?'disabled':''}} type="checkbox" value="{{$mctg->id}}"  name="ctg[]" autocomplete="off">{{$mctg->category_title}}<br><br>
        @if($hasSubMenu) <a onclick="changeCheckBox('{{$mctg->id}}');" href="javascript:void()"  style="color:#d26b6b">نمایش زیر دسته های این دسته بندی</a><br> @endif
    </div>
    @if($hasSubMenu)
        <div class="data" style="display: none;" id="checkCollection{{$mctg->id}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        @foreach($mctg->SubCategory3EnabledOrdered()->get() as $ctg)
                            <input {{($content->Categories3()->find($ctg->id)!=Null)?'checked':''}} type="checkbox" name="ctg[]" value="{{$ctg->id}}" autocomplete="off"> {{$ctg->category_title}}&nbsp;&nbsp;&nbsp;
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endforeach
@endsection
@section('mapscript')
    <script type="text/javascript">
        function changeCheckBox(ctg_id){
            $('#checkCollection'+ctg_id).slideToggle();
        }
    </script>
@endsection

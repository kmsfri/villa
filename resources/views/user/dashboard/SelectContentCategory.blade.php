@extends('user.dashboard.master')
@section('main')


    <div class="header-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                    <ul class="ul-header">
                        <!-- <li><a class="login" href="" title="محمد قلعه نوئی">محمد قلعه نوئی</a></li> -->
                        <li><a class="record" href="" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb">
        <li><a href="" title="پیشخوان">پیشخوان</a></li>
        <li><a href="" title="جاذبه های گردشگری">جاذبه های گردشگری</a></li>
        <li><a href="" title="ملک های من">افزودن جاذبه های گردشگری</a></li>
        <li><a href="" title="انتخاب دسته بندی">انتخاب دسته بندی</a></li>
    </ul>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form class="form" method="POST" action="{{Route('doEditContentCategory')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="content_id" value="{{ old('content_id',isset($content->id) ? $content->id : '') }}" autocomplete="off">
                    <div class="box-panel padding">
                        @if( Session::has('data') )
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('data') }}
                            </div>
                        @endif
                        <div class="header"><h3 class="title-box">انتخاب دسته بندی ها(انتخاب دسته بندی اجباری نیست)</h3><br></div>
                    </div>

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
                    <button class="btn btn-primary pull-left" type="submit">ذخیره</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('mapscript')
    <script type="text/javascript">
        function changeCheckBox(ctg_id){
            $('#checkCollection'+ctg_id).slideToggle();
        }
    </script>
@endsection

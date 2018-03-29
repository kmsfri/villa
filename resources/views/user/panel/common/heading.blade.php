<div class="header-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12"><a class="link d-inline-block d-md-none" id="toggle-menu" href="#" alt=""><span></span><span></span><span></span></a>
                <ul class="ul-header">
                    <li><a class="record" href="" title="ثبت رایگان ملک">ثبت رایگان ملک</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<ul class="breadcrumb">
    @foreach($sectionPath as $sp)
        <li><a href="" title="{{$sp->title}}">{{$sp->title}}</a></li>
    @endforeach
    @if(isset($headingButton))
    <a class="btn btn-info pull-left" href="{{$headingButton->url}}" title="{{$headingButton->title}}">{{$headingButton->title}}<i class="fa fa-file"></i></a>
    @endif
</ul>
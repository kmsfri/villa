@extends('user.web.master')
@section('header')
    @include('user.web.common.header')
@endsection
@section('main')



    <!--start section blog-->
    <section class="blog">
        <div class="container">
            <div class="row">
                @if(count($pinedcontents))
                    @foreach($pinedcontents as $pinedcontent)
                        <div class="col-sm-6 col-lg-4"><a href="{{route('showArticle',$pinedcontent->content_slug)}}" title="{{$pinedcontent->content_title}}">
                                <article class="article-blog">
                                    <figure>
                                        @if($pinedcontent->ContentImages()->first()!=Null)
                                        <img src="{{asset('images/users/user-uploads/user-contents').'/'.$pinedcontent->ContentImages()->first()->image_dir}}" alt="{{$pinedcontent->content_title}}">
                                        @else
                                            <img src="{{asset('images').'/404.jpg'}}" alt="{{$content->content_title}}"/>
                                        @endif
                                    </figure>
                                    <h2 class="title">{{$pinedcontent->content_title}}</h2>
                                </article></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!--end section blog-->
    <!--start nav-->
    <nav class="navbar navbar-expand-lg nav-blog">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent1" aria-controls="navbarContent1" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>
            <div class="collapse navbar-collapse" id="navbarContent1">
                <ul class="navbar-nav nav-blog">
                    @if(count($states))
                    <li class="dropdown"><a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="همه استان ها">همه استان ها</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($states as $state)
                                <a class="dropdown-item" href="#" title="{{$state->city_name}}">{{$state->city_name}}</a>
                            @endforeach
                        </div>
                    </li>
                    @endif
                    @if(count($categories))

                                @foreach($categories as $cat)
                                    @if($cat->SubCategory3EnabledOrdered()->count()>0)
                                            <li class="dropdown"><a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{{$cat->category_title}}">{{$cat->category_title}}</a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    @foreach($cat->SubCategory3EnabledOrdered()->where('show_in_blog',1)->get() as $sub)
                                                        @if($cat->id == $sub->parent_id)
                                                        <a class="dropdown-item" href="#" title="{{$sub->category_title}}">{{$sub->category_title}}</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                    @elseif($cat->parent_id == null)
                                    <li><a href="" title="{{$cat->category_title}}">{{$cat->category_title}}</a></li>
                                    @else
                                        @if($cat->SubCategory3EnabledOrdered()->count() == 0)
                                            @if($cat->ParentCategory3->show_in_blog == 0)
                                            <li><a href="" title="{{$cat->category_title}}">{{$cat->category_title}}</a></li>
                                            @endif
                                        @endif
                                    @endif

                                @endforeach

                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!--end nav-->
    <!--start section details-->
    <section class="details">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    @if(count($contents))
                    <div class="row">
                            @foreach($contents as $content)
                                <div class="col-sm-6 col-lg-4">
                                    <article class="blog">
                                        <figure><a href="{{route('showArticle',$content->content_slug)}}" title="{{$content->content_title}}">
                                                @if($content->ContentImages()->first()!=Null)
                                                <img src="{{asset('images/users/user-uploads/user-contents').'/'.$content->ContentImages()->first()->image_dir}}" alt="{{$content->content_title}}"/>
                                                @else
                                                    <img src="{{asset('images').'/404.jpg'}}" alt="{{$content->content_title}}"/>
                                                @endif

                                            </a></figure>
                                        <div class="data">
                                            <h3><a class="title" href="{{route('showArticle',$content->content_slug)}}" title="{{$content->content_title}}">{{$content->content_title}}</a></h3>
                                            <p>{{str_limit($content->content_short_desc,190)}}</p>
                                            <p class="author">
                                                @if($content->authorRenterUser()->first()!=Null)
                                                <img src="{{asset('images/users/user-uploads/user-pics').'/'.$content->authorRenterUser()->first()->avatar_dir}}" alt="{{$content->authorRenterUser()->first()->fullname}}"/>
                                                @endif
                                                @if($content->authorRenterUser()->first()!=Null)
                                                {{$content->authorRenterUser()->first()->fullname}}</p>
                                                @elseif($content->authorAdminUser()->first()!=Null)
                                                    مدیر سایت
                                                @else
                                                    ناشناس
                                                @endif
                                            <p class="day">@php \Carbon\Carbon::setLocale('fa'); @endphp {{$content->created_at->diffForHumans()}}</p><a class="more" href="{{route('showArticle',$content->content_slug)}}" title="ادامه مطلب">ادامه مطلب</a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach


                    </div>
                        <div class="pagination" style="display:table;margin:0 auto;">{!! str_replace('/?', '?', $contents->render()) !!}</div>
                    @endif

                </div>
@include('user.web.common.blogsidebar')
    <!--end section details-->





@endsection

<?php

namespace App\Http\Controllers\users\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\City;
use App\Models\ContentImage;
use App\Models\RenterUser;
use App\Models\Villa;
use App\Models\Category3;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlogController extends Controller
{
    public function websiteArticles(Request $request){
        $pinedcontents = Content::where('content_status',1)->where('is_draft',0)->where('show_in_blog',1)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->get();
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $categories = Category3::where('category_status',1)->where('show_in_blog',1)->orderBy('category_order','ASC')->get();


        if(isset($request->province_slug) && $request->province_slug!=Null){
            $province=\App\Models\City::where('city_slug',$request->province_slug)
                    ->where('city_status',1)
                    ->first();
            if($province==Null) abort(404);
            $cities=\App\Models\City::where('parent_id',$province->id)
                    ->where('city_status',1)
                    ->get();
            $city_id=[];
            foreach ($cities as $city){
                $city_id[]=$city->id;
            }
            $city_id[]=$province->id;
            $contents=Content::selectRaw('contents.*, contents.created_at as created_at, contents.updated_at as updated_at')
                ->where('content_status',1)
                ->where('is_draft',0)
                ->join('content_city', function($join) use($city_id){
                    $join->on('content_id','=','contents.id')
                    ->whereIn('city_id',$city_id);
                })
                ->orderBy('contents.created_at','DESC')
                ->orderBy('contents.content_order','ASC')
                ->paginate(12);

        }elseif(isset($request->category_slug) && $request->category_slug!=Null){


            $category=\App\Models\Category3::where('category_slug',$request->category_slug)
                ->where('category_status',1)
                ->first();
            if($category==Null) abort(404);

            $contents=$category->Contents()
                ->where('content_status',1)
                ->where('is_draft',0)
                ->orderBy('contents.created_at','DESC')
                ->orderBy('contents.content_order','ASC')
                ->paginate(12);



        }else{
            $contents = Content::where('content_status',1)
                ->where('is_draft',0)
                ->orderBy('created_at','DESC')
                ->orderBy('content_order','ASC')
                ->paginate(12);
        }






        $mostvisitcontents = Content::where('content_status',1)->where('is_draft',0)->orderBy('view_count','DESC')->orderBy('created_at','DESC')->take(6)->get();


        //begin set seo tags
        $meta=(object)[
            'title'=>'مطالب گردشگری', //Config--
            'keywords'=>'گردشگری, جاذبه طبیعی, جاذبه تفریحی, مکان تفریحی, میراث فرهنگی, جاذبه مذهبی, مناطق اقامتی, ویلاها, جاهای دیدنی', //Config--
            'description'=>'مکانهای تفریحی و گردشگری و مذهبی و اقامتی کشور', //Config--
        ];
        $canonical_url=urldecode(url(Route('websiteArticles')));
        $openGraph=(object)[
            'locale'=>'fa_IR',
            'type'=>'website',
            'title'=>'مطالب گردشگری',//Config--
            'description'=>'مکانهای تفریحی و گردشگری و مذهبی و اقامتی کشور', //Config--
            'url'=>urldecode(\URL::full()),
            'site_name'=>'ویلایار', //Config--
        ];
        //end set seo tags


        return view('user.web.blogpages.bloglist',[
            'pinedcontents'=>$pinedcontents,
            'states'=>$states,
            'categories'=>$categories,
            'contents'=>$contents,
            'mostvisitcontents'=>$mostvisitcontents,
            'meta'=>$meta,
            'openGraph'=>$openGraph,
            'canonical_url'=>$canonical_url,

        ]);
    }
    public function showArticle(Request $request){

        $content=$request->contentData;

        $mostvisitcontents = Content::where('content_status',1)->where('is_draft',0)->orderBy('view_count','DESC')->orderBy('created_at','DESC')->take(6)->get();
        $province_id = City::where('parent_id',$content->Cities()->first()->province()->first()->id);
        $related_villas = Villa::related_villas($province_id->pluck('id')->toArray(),0);

        //begin set seo tags
        $meta=(object)[
            'title'=>$content->content_title,
            'keywords'=>$content->content_tags,
            'description'=>$content->content_short_desc,
        ];
        $canonical_url=urldecode(url(Route('showArticle',$content->content_slug)));
        $openGraph=(object)[
            'locale'=>'fa_IR',
            'type'=>'website',
            'title'=>$content->content_title,
            'description'=>$content->content_short_desc,
            'url'=>urldecode(\URL::full()),
            'site_name'=>'ویلایار', //Config--
        ];
        if($content->ContentImages()->count()>0){
            $openGraph->image=asset('images/users/user-uploads/user-contents').'/'.$content->ContentImages()->first()->image_dir;
        }
        //end set seo tags




        return view('user.web.blogpages.singleblog',[
            'content'=>$content,
            'mostvisitcontents'=>$mostvisitcontents,
            'meta'=>$meta,
            'openGraph'=>$openGraph,
            'canonical_url'=>$canonical_url,
            'related_villas'=>$related_villas,
        ]);
    }
    public function content_comment(Request $request , $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'comment_text' => 'required|max:280',
            ]
        );

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());

        }
        if (Auth::guard('user')->check()){
            $attach_data[$id] = [
                'content_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'comment_text' => $request->comment_text

            ];
        $content = Content::findorfail($id);
        $content->RenterUserComments()->attach($attach_data);
            return redirect()->back()
                ->with('data','نظر شما با موفقیت ثبت شد، بعد از تایید مدیر نمایش داده می شود.');
    }
    else{
            return redirect(url('User/Login'));
    }

    }
}

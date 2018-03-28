<?php

namespace App\Http\Controllers\users\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\City;
use App\Models\ContentImage;
use App\Models\RenterUser;
use App\Models\Category3;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlogController extends Controller
{
    public function websiteArticles(){
        $pinedcontents = Content::where('content_status',1)->where('is_draft',0)->where('show_in_blog',1)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->get();
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $categories = Category3::where('category_status',1)->where('show_in_blog',1)->orderBy('category_order','ASC')->take(7)->get();
        $contents = Content::where('content_status',1)->where('is_draft',0)->orderBy('created_at','DESC')->orderBy('content_order','ASC')->paginate(2);
        $mostvisitcontents = Content::where('content_status',1)->where('is_draft',0)->orderBy('view_count','DESC')->orderBy('created_at','DESC')->take(6)->get();
        return view('user.web.blogpages.bloglist',[
            'pinedcontents'=>$pinedcontents,
            'states'=>$states,
            'categories'=>$categories,
            'contents'=>$contents,
            'mostvisitcontents'=>$mostvisitcontents
        ]);
    }
    public function showArticle($slug){
        $content = Content::where('content_slug','=',$slug)->where('content_status',1)->where('is_draft',0)->first();
        if(!isset($content)) abort(404);
        $mostvisitcontents = Content::where('content_status',1)->where('is_draft',0)->orderBy('view_count','DESC')->orderBy('created_at','DESC')->take(6)->get();
        return view('user.web.blogpages.singleblog',[
            'content'=>$content,
            'mostvisitcontents'=>$mostvisitcontents
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

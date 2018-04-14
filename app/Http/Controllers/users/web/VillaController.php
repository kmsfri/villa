<?php

namespace App\Http\Controllers\users\web;

use App\Models\RenterUser;
use App\Models\VillaReserveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Villa;
use App\Models\VillaImage;
use App\Models\Property;
use App\Models\City;
use App\Models\Category1;
use App\Models\WebsiteComment;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Validator;
class VillaController extends Controller
{
    public function showSingleVilla($slug){
        $villa = Villa::where('villa_slug','=',$slug)->where('villa_status',1)->first();
        if(!isset($villa)) abort(404);
        //begin set seo tags
        $meta=(object)[
            'title'=>$villa->villa_title,
            'keywords'=>$villa->villa_slug,
            'description'=>$villa->villa_description,
        ];
        $canonical_url=urldecode(url(Route('showvilla',$villa->villa_slug)));
        $openGraph=(object)[
            'locale'=>'fa_IR',
            'type'=>'website',
            'title'=>$villa->villa_title,
            'description'=>$villa->villa_description,
            'url'=>urldecode(\URL::full()),
            'site_name'=>'ویلایار', //Config--
        ];
        if($villa->VillaImages()->count()>0){
            $openGraph->image=asset('tmp').'/'.$villa->VillaImages()->first()->image_dir;
        }
        $villaprop = $villa->Properties()->get();
        $properties = Property::all();
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $province_id = City::where('parent_id',$villa->Cities()->first()->province()->first()->id);
        $related_villas = Villa::related_villas($province_id->pluck('id')->toArray(),$villa->id);
        $related_contents = Content::related_contents($province_id->pluck('id')->toArray());
        $user = $villa->RenterUser()->first();
        return view('user.web.villa.singlevilla',[
            'states'=>$states,
            'villa'=>$villa,
            'meta'=>$meta,
            'openGraph'=>$openGraph,
            'canonical_url'=>$canonical_url,
            'villaprop'=>$villaprop,
            'properties'=>$properties,
            'related_villas'=>$related_villas,
            'contents'=>$related_contents,
            'user'=>$user,
        ]);
        //end set seo tags
    }
    public function villa_comment(Request $request,$id){
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
                'villa_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'comment_text' => $request->comment_text

            ];
            $villa = Villa::findorfail($id);
            $villa->Comments()->attach($attach_data);
            return redirect()->back()
                ->with('data','نظر شما با موفقیت ثبت شد، بعد از تایید مدیر نمایش داده می شود.');
        }
        else{
            return redirect(url('User/Login'));
        }
    }
    public function showallvillas(){
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $villas = Villa::where('villa_status',1)->orderBy('created_at','DESC')->paginate(12);
        $categories1 = Category1::where('category_status',1)->orderBy('category_order','ASC')->get();
        $websitecomments = WebsiteComment::where('comment_status',1)->orderBy('created_at','DESC')->get();
        $contents = Content::where('content_status',1)->where('is_draft',0)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->take(6)->get();

        return view('user.web.villa.villalist',[
            'states'=>$states,
           'villas'=> $villas,
           'categories1'=> $categories1,
           'websitecomments'=>$websitecomments,
           'contents'=>$contents
        ]);


    }
    public function userpage($slug){
        $user = RenterUser::where('profile_slug',$slug)->first();
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $villas = Villa::where('renter_user_id',$user->id)->where('villa_status',1)->orderBy('created_at','DESC')->paginate(12);
        $categories1 = Category1::where('category_status',1)->orderBy('category_order','ASC')->get();
        $websitecomments = WebsiteComment::where('comment_status',1)->orderBy('created_at','DESC')->get();
        $contents = Content::where('renter_user_id',$user->id)->where('show_in_body',1)->where('content_status',1)->where('is_draft',0)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->take(6)->get();

        return view('user.web.villa.uservillalist',[
            'user'=>$user,
            'states'=>$states,
            'villas'=> $villas,
            'categories1'=> $categories1,
            'websitecomments'=>$websitecomments,
            'contents'=>$contents
        ]);

    }
    public function savewebsitecomment(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'websitecomment'=>'required|max:280',
            ]
        );
        if($validator->fails()){

            return redirect()->back()->with('errorcomment','<script>alert("ارسال نظر با مشکل مواجه شد، دوباره تلاش کنید");</script>');
        }
        if (Auth::guard('user')->check()){

            $websitecomment = new WebsiteComment();
            $websitecomment->comment_text = $request->websitecomment;
            $websitecomment->renter_user_id = Auth::guard('user')->user()->id;
            $websitecomment->save();
            return redirect()->back()
                ->with('errorcomment','<script>alert("نظر شما با موفقیت ثبت شد، بعد از تایید مدیر نمایش داده می شود.");</script>');
        }
        else{
            return redirect(url('User/Login'));
        }
    }
    public function reserve_request(Request $request , $id){
        $validator = Validator::make(
            $request->all(),
            [
                'fullname'=>'required|max:200',
                'phone'=>'required|digits:11',
                'date_in'=>['regex:/\d{4}-\d{2}-\d{2}$/'],
                'date_out'=>['regex:/\d{4}-\d{2}-\d{2}$/'],
                'pc'=>'integer',
            ]
        );
        if($validator->fails()){

            return redirect()->back()->withInput($request->input())
                ->withErrors($validator->errors())->with('errorcomment','<script>alert("ارسال درخواست رزرو با مشکل مواجه شد، ورودی های خود را بررسی کنید");</script>');
        }
        $reserve = new VillaReserveRequest();
        $reserve->date_in = \Helpers::convert_date_j_to_g($request->date_in,'/');
        $reserve->date_out = \Helpers::convert_date_j_to_g($request->date_out,'/');
        $reserve->people_count = $request->pc;
        $reserve->fullname = $request->fullname;
        $reserve->phone = $request->phone;
        $reserve->villa_id = $id;
        $reserve->save();
        return redirect()->back()->with('errorcomment','<script>alert("درخواست رزرو با موفقیت ارسال شد");</script>');
    }
}

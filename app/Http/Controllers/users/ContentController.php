<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\RenterUser;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\City;
use App\Models\ContentImage;
use DB;
class ContentController extends Controller
{
    public function addcontent(){
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $contentcount = Content::all()->count();
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        return view('user.dashboard.AddPost',['user'=>$user,'states'=>$states,'contentcount'=>$contentcount]);
    }
    public function editcontent($id){
        $content = Content::where('id',$id)->where('renter_user_id',Auth::guard('user')->user()->id)->first();
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $contentcount = Content::all()->count();
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        return view('user.dashboard.AddPost',['user'=>$user,'states'=>$states,'contentcount'=>$contentcount,'content'=>$content]);
    }


    public function addcontentaction(Request $request){
        $request->content_slug = \Helpers::make_slug($request->content_slug);
        $validator = Validator::make(
            $request->all(),
            [
                'image.*' => 'required|mimes:png,jpg,jpeg|max:2048',
                'content_title'=>'required|max:255',
                'content_tags'=>'required|max:255',
                'content_body'=>'required',
                'content_order'=>'required|integer',
                'latitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'longitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'content_slug'=>'required|max:30|unique:contents,content_slug,1'.$request->edit_id,
                'city'=>'required|max:30|exists:cities,id',
            ]
        );
        if($validator->fails()){

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }
        $uploaded_files_dir=array();
        $this->img_upload_error_msg=array();
        try {
            if($request->image!=Null) {
                foreach ($request->image as $key => $uimg) {

                    $file = $request->file('image.' . $key);
                    $fileName = "";


                    if ($file == null) {
                        $fileName = "";
                    } else {

                        if ($file->isValid()) {
                            $fileName = str_replace(' ', '', time()) . '.' . $file->guessClientExtension();
                            $destinationPath = public_path() . '/images/users/user-uploads/user-contents/';
                            $file->move($destinationPath, $fileName);
                            $uploaded_files_dir[] = $fileName;
                        } else {
                            $this->img_upload_error_msg = 'آپلود یکی از تصاویر ناموفق بود';
                            goto catch_block;
                        }
                    }
                }
            }




            DB::transaction(function() use($request,$uploaded_files_dir){
                $allowable_tags = "<p>,<b>,<i>,<table>,<tr>,<th>,<td>,<center>,<li>,<ul>,<a>,<pre>,<br>,<strong>,<span>,<label>,<em>,<div>,<tbody>,<h1>,<h2>,<h3>,<h4>,<h5>,<ol>,<blockquote>,<hr>";
            $request->content_body = strip_tags($request->content_body, $allowable_tags);

                if($request->edit_id!=Null) {




                    $content = Content::where('renter_user_id',Auth::guard('user')->user()->id)->where('id',$request->edit_id)->first()->get();

                    $to_remove_dir = Content::where('renter_user_id',Auth::guard('user')->user()->id)->where('id',$request->edit_id)->ContentImages()->get();
                   Content::where('renter_user_id',Auth::guard('user')->user()->id)->where('id',$request->edit_id)->ContentImages()->delete();


                }else{
                    $content=new Content();
                }

                //save db
                $content->content_title = $request->content_title;
                $content->content_tags = $request->content_tags;
                $content->content_order = $request->content_order;
                $content->content_slug = $request->content_slug;
                $content->content_body = $request->content_body;
                $content->renter_user_id = Auth::guard('user')->user()->id;
                if ($request->latitude != null){
                    $content->latitude = $request->latitude;
                }
                if ($request->longitude != null){
                    $content->longitude = $request->longitude;
                }
                $content->save();


                $img_data=array();
                foreach($uploaded_files_dir as $key=>$ufd){
                    $img_data[]=new ContentImage([
                        'content_id'=>$content->id,
                        'image_dir'=>$ufd,
                        'image_order'=>$key,
                    ]);
                }

                $content->Cities()->attach($request->city);
                $content->ContentImages()->saveMany($img_data);

                if($request->edit_id!=Null){
                    foreach($to_remove_dir as $uimg_dir){
                        if(file_exists(public_path().'/images/users/user-uploads/user-contents/'.$uimg_dir->image_dir)){
                            unlink(public_path().'/images/users/user-uploads/user-contents/'.$uimg_dir->image_dir);
                        }
                    }
                }

            });

        }
        catch(Exception $e) {
            catch_block:
            foreach($uploaded_files_dir as $uimg_dir){
                if(file_exists(public_path().'/images/users/user-uploads/user-contents/'.$uimg_dir)){
                    unlink(public_path().'/images/users/user-uploads/user-contents/'.$uimg_dir);
                }
            }
            return redirect()->back()
                ->withInput($request->input())
                ->with('data','عملیات با شکست مواجه شد، دوباره تلاش کنید');

        }
        return redirect()->back()
            ->with('data','با موفقیت ذخیره شد');

    }
    public function contents(){
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        $contents = Content::where('renter_user_id',Auth::guard('user')->user()->id)->paginate(11);
        return view('user.dashboard.PostsList',['user'=>$user,'contents'=>$contents]);
    }
    public function showinbody($id){
        $content = Content::where('id',$id)->where('renter_user_id',Auth::guard('user')->user()->id)->where('content_status',1)->get()->first();
        if(isset($content)){
            if ($content->show_in_body != 0){
                $content->show_in_body = 0;
                $content->save();
                return redirect()->back()->with('data','تغییرات با موفقیت اعمال شد');
            }
            else{
                $content->show_in_body = 1;
                $content->save();
                return redirect()->back()->with('data','تغییرات با موفقیت اعمال شد');
            }
        }
        else{
            return redirect()->back()->with('data','چنین مطلبی وجود ندارد و یا غیر فعال است');
        }
    }
}

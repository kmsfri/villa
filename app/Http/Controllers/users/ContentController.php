<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\RenterUser;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Validator;
use App\Models\City;
use App\Models\ContentImage;
use DB;
use Intervention\Image\Facades\Image;
class ContentController extends Controller
{
    public function addcontent(){
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $contentcount = Content::where('renter_user_id',Auth::guard('user')->user()->id)->count();
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        $cities=array();
        return view('user.dashboard.AddPost',['user'=>$user,'states'=>$states, 'cities'=>$cities,'contentcount'=>$contentcount]);
    }
    public function editcontent($id){
        $content = Content::where('id',$id)->where('renter_user_id',Auth::guard('user')->user()->id)->first();
        if(empty($content))die('invalid_request!');

        $states=\App\Models\City::select('*')
            ->where('parent_id','=',Null)
            ->where('city_status','=','1')
            ->orderBy('city_order','ASC')
            ->orderBy('created_at')->get();
        if($content->cities()->count()>0){

            $master_province=$content->cities()->first()->Province()->first();
            $cities=\App\Models\City::selectRaw('id , city_name')
                ->where('parent_id','=',$master_province->id)
                ->where('city_status','=',1)
                ->orderBy('city_order' , 'ASC')
                ->orderBy('created_at')
                ->get();
            $content->province=$master_province->id;
            $content->city_id=$content->cities()->first()->id;

        }else{
            $cities=array();
        }

        $contentcount = Content::where('renter_user_id',Auth::guard('user')->user()->id)->count();
        $user = RenterUser::find(Auth::guard('user')->user()->id);

        $data=[
            'user'=>$user,
            'states'=>$states,
            'cities'=>$cities,
            'contentcount'=>$contentcount,
            'content'=>$content,
        ];

        return view('user.dashboard.AddPost',$data);
    }


    public function addcontentaction(Request $request){



        if(isset($request->content_slug) && $request->content_slug!=null){
            $content_slug = \Helpers::make_slug($request->content_slug);
        }


        $newRequest=[
            'newImg.*' => $request->newImg,
            'oldImg.*' => $request->oldImg,
            'content_title'=>$request->content_title,
            'content_tags'=>$request->content_tags,
            'content_body'=>$request->content_body,
            'content_order'=>$request->content_order,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'content_slug'=>$content_slug,
            'city'=>$request->city,
        ];



        $validator = Validator::make(
            $newRequest,
            [
                'newImg.*' => 'mimes:png,jpg,jpeg|max:2048',
                'oldImg.*' => 'integer|exists:content_images,id',
                'content_title'=>'required|max:255',
                'content_tags'=>'required|max:255',
                'content_body'=>'required',
                'content_order'=>'required|integer',
                'latitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'longitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'content_slug'=>'required|max:30|unique:contents,content_slug,'.$request->edit_id,
                'city'=>'required|max:30|exists:cities,id',
            ]
        );


        if($validator->fails()){



            if($request->state!=Null){
                if(\App\Models\City::find($request->state)!=Null){
                    $cities=\App\Models\City::selectRaw('id , city_name')
                        ->where('parent_id','=',$request->state)
                        ->where('city_status','=',1)
                        ->orderBy('city_order' , 'ASC')
                        ->orderBy('created_at')
                        ->get();
                }else{
                    $cities=array();
                }
            }else{
                $cities=array();
            }

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید')
                ->with(['cities'=>$cities]);
        }






        $uploaded_files_dir=array();
        $this->img_upload_error_msg=array();
        try {

            if($request->newImg!=Null) {
                foreach ($request->newImg as $key => $uimg) {
                    $file = $request->file('newImg.' . $key);
                    $fileName = "";
                    if ($file == null) {
                        $fileName = "";
                    } else {
                        if ($file->isValid()) {
                            $fileName = Auth::guard('user')->user()->id.str_replace(' ', '', time()).rand(1000,9999). '.' . $file->guessClientExtension();
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

            $removableOldImgID=array();
            $removableOldImgDir=array();

            if(isset($request->edit_id) && $request->edit_id!=Null){
                $user=Auth::guard('user')->user();
                $content=Content::where('id',$request->edit_id)->where('renter_user_id',$user->id)->first();
                if($content==Null)die('invalid_request!');

                foreach($content->ContentImages()->get() as $cimg){
                    $exists=false;
                    if($request->oldImg!=Null){
                        foreach($request->oldImg as $oimg){
                            if($oimg==$cimg->id){
                                $exists=True;
                                break;
                            }
                        }
                    }
                    if(!$exists){
                        $removableOldImgID[]=$cimg->id;
                        $removableOldImgDir[]=$cimg->image_dir;
                    }
                }
            }else{
                $content=new Content();
            }


            DB::transaction(function() use($request,$uploaded_files_dir,$removableOldImgID,$removableOldImgDir,$content,$content_slug){
                $allowable_tags = "<p>,<b>,<i>,<table>,<tr>,<th>,<td>,<center>,<li>,<ul>,<a>,<pre>,<br>,<strong>,<span>,<label>,<em>,<div>,<tbody>,<h1>,<h2>,<h3>,<h4>,<h5>,<ol>,<blockquote>,<hr>";
                $request->content_body = strip_tags($request->content_body, $allowable_tags);

                //save db
                $content->content_title = $request->content_title;
                $content->content_tags = $request->content_tags;
                $content->content_order = $request->content_order;
                $content->content_slug = $content_slug;
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




                $content->ContentImages()->whereIn('id',$removableOldImgID)->delete();

                $content->Cities()->sync($request->city);



                $content->ContentImages()->saveMany($img_data);

                if($request->edit_id!=Null){
                    foreach($removableOldImgDir as $uimg_dir){
                        if(file_exists(public_path().'/images/users/user-uploads/user-contents/'.$uimg_dir)){
                            unlink(public_path().'/images/users/user-uploads/user-contents/'.$uimg_dir);
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

        if(isset($request->edit_id) && $request->edit_id!=Null){
            $msg="مطلب مورد نظر با موفقیت ویرایش شد";
        }else{
            $msg="مطلب جدید با موفقیت اضافه شد";
        }
        return redirect(url(Route('editContentCategory',$content->id)))->with('data', $msg);

    }





    public function editContentCategory(Request $request){

        $user=Auth::guard('user')->user();

        $content=Content::where('id',$request->content_id)
                        ->where('renter_user_id',$user->id)
                        ->first();
        if($content==Null)die('invalid request!');

        $masterCtgs=\App\Models\Category3::where('category_status',1)
                    ->where('parent_id',Null)
                    ->orderBy('category_order','ASC')
                    ->orderBy('created_at','DESC')
                    ->get();




        $data=[
            'user'=>$user,
            'masterCtgs'=>$masterCtgs,
            'content'=>$content,
        ];

        return view('user.dashboard.SelectContentCategory',$data);
    }


    public function doEditContentCategory(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'ctg.*' => 'integer|exists:categories3,id',
                'content_id'=>'required|exists:contents,id',
            ]
        );



        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }

        $user=Auth::guard('user')->user();



        $content=Content::where('id',$request->content_id)
                    ->where('renter_user_id',$user->id)
                    ->first();

        if($content==Null)die('invalid request!');


        $content->Categories3()->sync($request->ctg);




        $msg=['دسته بندی مطلب مورد نظر با موفقیت بروزرسانی شد'];
        return redirect(url(Route('showdashboard')))->with('data', $msg);




    }
    public function contents(){
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        $contents = Content::where('renter_user_id',Auth::guard('user')->user()->id)->paginate(11);
        return view('user.dashboard.PostsList',['user'=>$user,'contents'=>$contents]);
    }
    public function showinbody($id){

        $showInBodyCount = Content::where('renter_user_id',Auth::guard('user')->user()->id)->where('show_in_body',1)->where('content_status',1)->count();
        if($showInBodyCount>6){
            return redirect()->back()->with('data','تعداد مطالب پین شده نمیتواند بیشتر از 6 عدد باشد');
        }

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

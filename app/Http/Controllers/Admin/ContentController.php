<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Content;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\ContentImage;
use DB;
use \App\Models\UserContentComments;
class ContentController extends Controller
{
    public function showContentList(Request $request){
        $contents = Content::orderBy('updated_at','DESC')->orderBy('created_at','ASC')->paginate(10);
        $data=[
            'title'=>'لیست مطالب بخش گردشتگری وبسایت',
            'add_url'=>Route('adminAddContentForm'),
            'del_url'=>Route('adminRemoveContent'),
            'contents'=>$contents,
        ];
        return view('admin.pages.lists.contents',$data);
    }

    public function addContent(){
        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $cities=array();
        $data=[
            'title'=>'افزودن مطلب جدید به بخش گردشگری',
            'request_type'=>'add',
            'post_add_url'=>Route('adminDoSaveContent'),
            'states'=>$states,
            'cities'=>$cities,
        ];
        return view('admin.pages.forms.add_post',$data);
    }


    public function editcontent($id){
        $content = Content::where('id',$id)->first();
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

        $data=[
            'title'=>'ویرایش مطلب بخش گردشگری',
            'request_type'=>'edit',
            'post_edit_url'=>Route('adminDoSaveContent'),
            'states'=>$states,
            'cities'=>$cities,
            'content'=>$content,
            'edit_id'=>$content->id,
        ];

        return view('admin.pages.forms.add_post',$data);
    }



    public function doSaveContent(Request $request){


        if(isset($request->content_slug) && $request->content_slug!=null){
            $content_slug = \Helpers::make_slug($request->content_slug);
        }

        $newRequest=[
            'newImg.*' => $request->newImg,
            'oldImg.*' => $request->oldImg,
            'content_title'=>$request->content_title,
            'content_tags'=>$request->content_tags,
            'content_body'=>$request->content_body,
            'content_short_desc'=>nl2br($request->content_short_desc),
            'content_order'=>$request->content_order,
            'content_status'=>$request->content_status,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'content_slug'=>$content_slug,
            'is_draft'=>$request->is_draft,
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
                'content_short_desc'=>'required|min:140|max:230',
                'content_order'=>'required|integer',
                'content_status'=>'required|integer',
                'latitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'longitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'content_slug'=>'required|max:30|unique:contents,content_slug,'.$request->edit_id,
                'is_draft'=>'required|integer',
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
                ->with('messages',['ورودی های خود را بررسی کنید'])
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
                            $fileName = Auth::guard('admin')->user()->id.str_replace(' ', '', time()).rand(1000,9999). '.' . $file->guessClientExtension();
                            $destinationPath = public_path() . '/images/users/user-uploads/user-contents/';
                            $imgConf=[
                                'imgType'=>'blogImage',
                                'imgObject'=>$file,
                                'resultDir'=>$destinationPath.'/'.$fileName,
                            ];
                            \Helpers::save_img($imgConf['imgType'],$imgConf['imgObject'],$imgConf['resultDir']);
                            //$file->move($destinationPath, $fileName);
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

                $content=Content::where('id',$request->edit_id)->first();
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
                $content->content_short_desc = $request->content_short_desc;
                if(!isset($request->edit_id) || $request->edit_id==Null){
                    $content->admin_user_id = Auth::guard('admin')->user()->id;
                }
                if ($request->latitude != null){
                    $content->latitude = $request->latitude;
                }
                if ($request->longitude != null){
                    $content->longitude = $request->longitude;
                }
                $content->is_draft = $request->is_draft;
                $content->content_status = $request->content_status;
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
                ->with('messages',['عملیات با شکست مواجه شد، دوباره تلاش کنید']);

        }

        if(isset($request->edit_id) && $request->edit_id!=Null){
            $msg=["مطلب مورد نظر با موفقیت ویرایش شد"];
        }else{
            $msg=["مطلب جدید با موفقیت اضافه شد"];
        }
        return redirect(url(Route('adminEditContentCategory',$content->id)))->with('messages', $msg);
    }




    public function editContentCategory(Request $request){

        $content=Content::where('id',$request->content_id)
            ->first();
        if($content==Null)die('invalid request!');

        $masterCtgs=\App\Models\Category3::where('category_status',1)
            ->where('parent_id',Null)
            ->orderBy('category_order','ASC')
            ->orderBy('created_at','DESC')
            ->get();





        $data=[
            'title'=>'انتخاب دسته بندی',
            'request_type'=>'edit',
            'post_edit_url'=>Route('adminDoEditContentCategory'),
            'masterCtgs'=>$masterCtgs,
            'content'=>$content,
            'edit_id'=>$content->id,
        ];

        return view('admin.pages.forms.SelectContentCategory',$data);


    }


    public function doEditContentCategory(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'ctg.*' => 'integer|exists:categories3,id',
                'edit_id'=>'required|exists:contents,id',
            ]
        );



        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('messages',['ورودی های خود را بررسی کنید']);
        }





        $content=Content::where('id',$request->edit_id)
            ->first();
        if($content==Null)die('invalid request!');


        $content->Categories3()->sync($request->ctg);


        $msg=['دسته بندی مطلب مورد نظر با موفقیت بروزرسانی شد'];
        return redirect(url(Route('adminShowContentList')))->with('messages', $msg);


    }




    public function showInBlog($id){

        $showInBlogCount = Content::where('show_in_blog',1)->where('content_status',1)->count();
        if($showInBlogCount>6){
            return redirect()->back()->with('messages',['تعداد مطالب پین شده نمیتواند بیشتر از 6 عدد باشد']);
        }

        $content = Content::where('id',$id)->where('content_status',1)->get()->first();
        if(isset($content)){
            if ($content->show_in_blog != 0){
                $content->show_in_blog = 0;
                $content->save();
                return redirect()->back()->with('messages',['تغییرات با موفقیت اعمال شد']);
            }
            else{
                $content->show_in_blog = 1;
                $content->save();
                return redirect()->back()->with('messages',['تغییرات با موفقیت اعمال شد']);
            }
        }
        else{
            return redirect()->back()->with('messages',['چنین مطلبی وجود ندارد و یا غیر فعال است']);
        }
    }



    public function doRemoveContent(Request $request){
        if(isset($request->remove_val)){
            \App\Models\Content::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminShowContentList')))->with('messages', $msg);
    }

























    public function Comments(Request $request){

        if(isset($request->content_id) && $request->content_id!=Null){
            $content=content::find($request->content_id);
            if($content==Null) abort(404);

            $comments=UserContentComments::where('content_id',$content->id)
                ->orderBy('created_at','DESC')
                ->orderBy('updated_at','DESC')
                ->get();

            $title="نظرات مطلب: ".$content->content_title;

        }else{
            $comments=UserContentComments::orderBy('created_at','DESC')
                ->orderBy('updated_at','DESC')
                ->get();
            $title="نظرات ثبت شده برای مطالب";
        }

        $backward_url=Route('dashboard');
        $add_url=Null;
        $del_url=Route('doDeleteContentComment');

        $resp=[
            'comments'=>$comments,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];



        return view('admin.pages.lists.contentComments' ,$resp);
    }


    public function editComment(Request $request){
        if($request->id!=Null){
            $comment=UserContentComments::find($request->id);
            if($comment==Null) abort(404);
            $title="مشاهده نظر ";
            $backward_url=Route('adminContentCommentList');
        }else{
            abort(404);
        }


        $data=[
            'request_type'=>'edit',
            'comment'=>$comment,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('doEditContentComment'),
            'edit_id'=>$comment->id,
        ];

        return view('admin.pages.forms.add_contentComment' ,$data);

    }



    public function doEditComment(Request $request){

        $validator = Validator::make($request->all(),[
            'comment_text'=>'required|max:280',
            'comment_status'=>'required|integer',
            'edit_id'=>'required|integer|exists:user_content_comments,id',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if($this->changeUserContentComment($request)){
            $msg=['نظر مورد نظر با موفقیت بروزرسانی شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminContentCommentList')))->with('messages', $msg);

    }


    private function changeUserContentComment($request){
        if($request->edit_id!=Null) {
            $comment=UserContentComments::find($request->edit_id);
            if($comment==Null) abort(404);
        }else{
            abort(404);
        }



        $comment->comment_text=nl2br($request->comment_text);
        $comment->comment_status=$request->comment_status;
        $comment->save();

        return True;

    }



    public function deleteComment(Request $request){

        if(isset($request->remove_val)){
            UserContentComments::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminContentCommentList')))->with('messages', $msg);
    }











}

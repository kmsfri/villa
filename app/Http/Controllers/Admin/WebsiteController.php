<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\WebsiteComment;
use Validator;
class WebsiteController extends Controller
{
    public function Comments(Request $request){

        $comments=WebsiteComment::orderBy('created_at','DESC')
            ->orderBy('updated_at','DESC')
            ->get();
        $title="نظرات ثبت شده وبسایت";

        $backward_url=Route('dashboard');
        $add_url=Null;
        $del_url=Route('doDeleteWebsiteComment');

        $resp=[
            'comments'=>$comments,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];



        return view('admin.pages.lists.websiteComments' ,$resp);
    }


    public function editComment(Request $request){
        if($request->id!=Null){
            $comment=WebsiteComment::find($request->id);
            if($comment==Null) abort(404);
            $title="مشاهده نظر ";
            $backward_url=Route('adminWebsiteCommentList');
        }else{
            abort(404);
        }


        $data=[
            'request_type'=>'edit',
            'comment'=>$comment,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('doEditWebsiteComment'),
            'edit_id'=>$comment->id,
        ];

        return view('admin.pages.forms.add_websiteComment' ,$data);

    }



    public function doEditComment(Request $request){

        $validator = Validator::make($request->all(),[
            'comment_text'=>'required|max:280',
            'comment_status'=>'required|integer',
            'edit_id'=>'required|integer|exists:website_comments,id',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if($this->changeWebsiteComment($request)){
            $msg=['نظر مورد نظر با موفقیت بروزرسانی شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminWebsiteCommentList')))->with('messages', $msg);

    }


    private function changeWebsiteComment($request){
        if($request->edit_id!=Null) {
            $comment=WebsiteComment::find($request->edit_id);
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
            WebsiteComment::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminWebsiteCommentList')))->with('messages', $msg);
    }
}

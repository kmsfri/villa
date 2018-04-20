<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\WebsiteComment;
use Validator;
use DB;
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











    public function footerLinks(Request $request){

        if($request->parent_id!=Null){
            $parent_ctg=\App\Models\FooterLink::find($request->parent_id);
            $parent_ctg_level2=\App\Models\FooterLink::find($parent_ctg->parent_id);
            if($parent_ctg_level2==Null){
                $title="زیرمجموعه های لینک: ". $parent_ctg->link_title;
                $backward_url=Route('footerLink_list').'/'.$parent_ctg->id;
                $add_url=Route('add_footerLink_form',$parent_ctg->id);
                $canHasSubCategory=false;
            }else{
                /*
                $title="زیرمجموعه های دسته بندی: ". $parent_ctg->category_title;
                $backward_url=Route('categories3-list');
                $add_url=Route('add-category3-form',$parent_ctg->id);
                $canHasSubCategory=false;
                */
            }

        }else{
            $title="لیست لینک های فوتر";
            $backward_url=Route('dashboard');
            $add_url=Route('add_footerLink_form');
            $canHasSubCategory=true;
        }

        $links=\App\Models\FooterLink::select('*')->where('parent_id','=',$request->parent_id)->orderBy('created_at')->get();

        $del_url=Route('do_delete_footerLink',$request->parent_id);

        $resp=[
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url,
            'links'=>$links,
            'parent_id'=>$request->parent_id,
            'canHasSubCategory'=>$canHasSubCategory,
        ];


        return view('admin.pages.lists.footer_links' ,$resp);
    }

    public function showAddFooterLinkForm(Request $request){

        if($request->parent_id!=Null){
            $parent_ctg=\App\Models\FooterLink::find($request->parent_id);
            $parent_ctg_level2=\App\Models\FooterLink::find($parent_ctg->parent_id);
            if($parent_ctg_level2==Null){
                $title="افزودن لینک جدید به: ". $parent_ctg->link_title;
            }else{
                //$title="افزودن دسته بندی مطالب گردشگری جدید به: ". $parent_ctg->category_title." - متعلق به: ".$parent_ctg_level2->category_title;
            }

        }else{
            $title="افزودن لینک فوتر جدید";
        }
        $backward_url=Route('footerLink_list',$request->parent_id);

        $resp=[
            'title'=>$title,
            'post_add_url'=>Route('do_add_footerLink'),
            'request_type'=>'add',
            'parent_id'=>$request->parent_id,
            'backward_url'=>$backward_url,
        ];
        return view('admin.pages.forms.add_footer_link' ,$resp);
    }


    public function saveFooterLink(Request $request){

        $this->validate($request, [
            'link_title' => 'required|min:2|max:255',
            'parent_id'=>'nullable|exists:footer_links,id',
            'link_order'=>'required|integer',
            'link_url'=>'nullable|max:255',
            'link_status'=>'required|integer',
        ]);


        $link= new \App\Models\FooterLink();
        $link->link_title=$request->link_title;
        $link->parent_id=$request->parent_id;
        $link->link_order=$request->link_order;
        $link->link_url=$request->link_url;
        $link->link_status=$request->link_status;
        $link->save();


        $msg=['لینک جدید با موفقیت افزوده شد'];

        return redirect(url(Route('footerLink_list',$request->parent_id)))->with('messages', $msg);


    }






    public function editFooterLink(Request $request){



        $ctg=\App\Models\FooterLink::where('id','=',$request->id)->first();
        if($ctg==Null){
            die('invalid request!');
        }

        $parent=$ctg->ParentLink()->first();
        if($parent==Null){
            $parent_id=Null;
            $title="ویرایش  ".$ctg->link_title;
        }else{

            $parent_ctg_level2=$parent->ParentLink()->first();
            if($parent_ctg_level2==Null){
                $title="ویرایش  ".$ctg->link_title." متعلق به: ". $parent->link_title;
            }else{
                //$title="ویرایش  ".$ctg->category_title." متعلق به: ". $parent->category_title." - ".$parent_ctg_level2->category_title;
            }
            $parent_id=$parent->id;
        }

        $backward_url=Route('footerLink_list',$request->parent_id);


        $resp=[
            'link'=>$ctg,
            'request_type'=>'edit',
            'post_edit_url'=>Route('do_edit_footerLink'),
            'parent_id'=>$parent_id,
            'edit_id'=>$ctg->id,
            'title'=>$title,
            'backward_url'=>$backward_url,
        ];


        return view('admin.pages.forms.add_footer_link' ,$resp);
    }


    public function doEditFooterLink(Request $request){

        $this->validate($request, [
            'link_title' => 'required|min:2|max:255',
            'link_order'=>'required|integer',
            'link_url'=>'nullable|max:255',
            'link_status'=>'required|integer',
            'edit_id' => 'required|exists:footer_links,id',
        ]);


        $link=\App\Models\FooterLink::find($request->edit_id);
        $link->link_title=$request->link_title;
        $link->link_order=$request->link_order;
        $link->link_url=$request->link_url;
        $link->link_status=$request->link_status;
        $link->save();


        $msg=[
            'لینک مورد نظر با موفقیت ویرایش شد'
        ];
        return redirect(url(Route('footerLink_list',$link->parent_id)))->with('messages', $msg);

    }




    public function deleteFooterLink(Request $request){

        if(isset($request->remove_val)){
            \App\Models\FooterLink::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('footerLink_list',$request->parent_id)))->with('messages', $msg);


    }
















    public function socials(Request $request){

        $s=\App\Models\Social::select('*')->orderBy('s_order','ASC')->orderBy('s_status','DESC')->orderBy('created_at','DESC')->get();

        $add_url=Route('addSocialForm');
        $del_url=Route('doDeleteSocial');
        $title="شبکه های اجتماعی";


        $data=[
            'socials'=>$s,
            'add_url'=>$add_url,
            'del_url'=>$del_url,
            "title"=>$title
        ];

        return view('admin.pages.lists.socials' ,$data);
    }

    public function showAddSocialForm(){

        $title="افزودن شبکه اجتماعی جدید";

        $post_add_url=Route('doAddSocial');


        $resp=[
            'request_type'=>'add',
            'title'=>$title,
            'post_add_url'=>$post_add_url

        ];
        return view('admin.pages.forms.add_social' ,$resp);
    }

    public function saveSocial(Request $request){

        $validator = Validator::make($request->all(),[
            's_title'=>'required|min:3|max:100',
            's_link'=>'max:50',
            'img_dir'=>'mimes:png,jpg,jpeg|max:1048',
            's_order'=>'required|integer',
            's_status'=>'required|integer',
        ]);



        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(['messages'=>$this->img_upload_error_msg]);;
        }



        if($this->changeSocial($request)){
            $msg=['شبکه اجتماعی جدید با موفقیت به سیستم اضافه شد'];
        }else{

            goto validator_fails;
        }

        return redirect(Route('adminSocials'))->with('messages', $msg);

    }






    private function changeSocial($request){
        $uploaded_file_dir="";
        $this->img_upload_error_msg=array();
        $to_remove_dir="";
        try {
            if($request->img_dir!=Null) {

                $file = $request->file('img_dir');
                $fileName = "";

                if ($file == null) {
                    $fileName = "";
                } else {

                    if ($file->isValid()) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $destinationPath = '/uploads/social';
                        $file->move(public_path() . $destinationPath, $fileName);
                        $uploaded_file_dir =  $destinationPath .'/'.$fileName;
                        if($request->edit_id!=Null) {
                            $to_remove_dir = \App\Models\Social::find($request->edit_id)->img_dir;
                        }
                    } else {
                        $this->img_upload_error_msg = 'آپلود تصویر ناموفق بود';
                        goto catch_block;
                    }
                }

            }

            DB::transaction(function() use($request,$uploaded_file_dir,$to_remove_dir){


                if($request->edit_id!=Null) {

                    $social=\App\Models\Social::find($request->edit_id);
                }else{
                    $social=new \App\Models\Social();
                }

                $social->s_title=$request->s_title;
                $social->s_link=$request->s_link;
                if($uploaded_file_dir!=""){
                    $social->img_dir=$uploaded_file_dir;
                }
                $social->s_order=$request->s_order;
                $social->s_status=$request->s_status;

                $social->save();


                if($request->edit_id!=Null && $to_remove_dir!=""){
                    if(file_exists(public_path().'/'.$to_remove_dir))
                        unlink(public_path().'/'.$to_remove_dir);
                }

            });





        }
        catch(Exception $e) {
            catch_block:

            if(file_exists(public_path().'/'.$uploaded_file_dir))
                unlink(public_path().'/'.$uploaded_file_dir);

            return false;

        }

        return true;
    }


















    public function deleteSocial(Request $request){

        if(isset($request->remove_val)){
            foreach($request->remove_val as $c_id){
                $u=\App\Models\Social::find($c_id);
                if($u!=Null && $u->img_dir!=null && trim($u->img_dir)!=''){

                    if(file_exists(public_path().'/'.$u->img_dir))
                        unlink(public_path().'/'.$u->img_dir);
                }
                unset($u);
            }

            \App\Models\Social::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];
        return redirect(Route('adminSocials'))->with('messages', $msg);


    }



    public function editSocial(Request $request){



        if($request->id!=Null){
            $s=\App\Models\Social::find($request->id);
            if($s==Null) abort(404);

            $title="ویرایش شبکه اجتماعی";
        }else{
            die('invalid request!');
        }


        $post_edit_url=Route('doEditSocial');

        $data=[
            'request_type'=>'edit',
            's'=>$s,
            'title'=>$title,
            'post_edit_url'=>$post_edit_url,
            'edit_id'=>$request->id,
        ];


        return view('admin.pages.forms.add_social' ,$data);


    }


    public function doEditSocial(Request $request){



        $validator = Validator::make(
            $request->all(),
            [
                'edit_id'=>'required|integer|exists:social_media,id',
                's_title'=>'required|min:3|max:100',
                's_link'=>'max:50',
                'img_dir'=>'mimes:png,jpg,jpeg|max:1048',
                's_order'=>'required|integer',
                's_status'=>'required|integer',
            ]
        );


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(['messages'=>$this->img_upload_error_msg]);;
        }


        if($this->changeSocial($request)){
            $msg=['شبکه اجتماعی مورد نظر با موفقیت ویرایش شد'];
        }else{
            goto validator_fails;
        }




        return redirect(Route('adminSocials'))->with('messages', $msg);



    }
















    public function menuLinks(Request $request){

        $title="لیست لینکهای منو";
        $backward_url=Route('dashboard');
        $add_url=Route('add_menuLink_form');
        $canHasSubCategory=false;

        $links=\App\Models\MenuLink::select('*')->where('parent_id','=',$request->parent_id)->orderBy('created_at')->get();


        $del_url=Route('do_delete_menuLink',$request->parent_id);

        $resp=[
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url,
            'links'=>$links,
            'parent_id'=>$request->parent_id,
            'canHasSubCategory'=>$canHasSubCategory,
            'type'=>'menuLinks',
        ];


        return view('admin.pages.lists.footer_links' ,$resp);
    }

    public function showAddMenuLinkForm(Request $request){

        $title="افزودن لینک منوی جدید";
        $backward_url=Route('menuLink_list',$request->parent_id);

        $resp=[
            'title'=>$title,
            'post_add_url'=>Route('do_add_menuLink'),
            'request_type'=>'add',
            'parent_id'=>$request->parent_id,
            'backward_url'=>$backward_url,
        ];
        return view('admin.pages.forms.add_footer_link' ,$resp);
    }


    public function saveMenuLink(Request $request){

        $this->validate($request, [
            'link_title' => 'required|min:2|max:255',
            'link_order'=>'required|integer',
            'link_url'=>'nullable|max:255',
            'link_status'=>'required|integer',
        ]);


        $link= new \App\Models\MenuLink();
        $link->link_title=$request->link_title;
        $link->parent_id=Null;
        $link->link_order=$request->link_order;
        $link->link_url=$request->link_url;
        $link->link_status=$request->link_status;
        $link->save();


        $msg=['لینک جدید با موفقیت افزوده شد'];

        return redirect(url(Route('menuLink_list',$request->parent_id)))->with('messages', $msg);

    }


    public function editMenuLink(Request $request){


        $ctg=\App\Models\MenuLink::where('id','=',$request->id)->first();
        if($ctg==Null){
            die('invalid request!');
        }


        $parent_id=Null;
        $title="ویرایش  ".$ctg->link_title;

        $backward_url=Route('menuLink_list',$request->parent_id);


        $resp=[
            'link'=>$ctg,
            'request_type'=>'edit',
            'post_edit_url'=>Route('do_edit_menuLink'),
            'parent_id'=>$parent_id,
            'edit_id'=>$ctg->id,
            'title'=>$title,
            'backward_url'=>$backward_url,
        ];


        return view('admin.pages.forms.add_footer_link' ,$resp);
    }


    public function doEditMenuLink(Request $request){

        $this->validate($request, [
            'link_title' => 'required|min:2|max:255',
            'link_order'=>'required|integer',
            'link_url'=>'nullable|max:255',
            'link_status'=>'required|integer',
            'edit_id' => 'required|exists:menu_links,id',
        ]);


        $link=\App\Models\MenuLink::find($request->edit_id);
        $link->link_title=$request->link_title;
        $link->link_order=$request->link_order;
        $link->link_url=$request->link_url;
        $link->link_status=$request->link_status;
        $link->save();


        $msg=[
            'لینک مورد نظر با موفقیت ویرایش شد'
        ];
        return redirect(url(Route('menuLink_list',$link->parent_id)))->with('messages', $msg);

    }




    public function deleteMenuLink(Request $request){

        if(isset($request->remove_val)){
            \App\Models\MenuLink::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('menuLink_list',$request->parent_id)))->with('messages', $msg);


    }













}

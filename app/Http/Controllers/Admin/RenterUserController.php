<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;


class RenterUserController extends Controller
{
    var $img_upload_error_msg='';

    var $fileUploadDir='/images/users/user-uploads/user-pics';

    public function showRenterUsers(Request $request){

        $users=\App\Models\RenterUser::select('*')
            ->orderBy('user_status','DESC')
            ->orderBy('created_at','ASC')
            ->get();

        $title="لیست کاربران ویسایت";
        $backward_url=Route('dashboard');
        $add_url=Route('add_renter_form');
        $del_url=Route('delete_renter_user');

        $resp=[
            'users'=>$users,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];

        return view('admin.pages.lists.renter_users' ,$resp);
    }


    public function showAddRenterUserForm(Request $request){

        $title="افزودن کاربر جدید به وبسایت";
        $backward_url=Route('renter-user-list');


        $data=[
            'request_type'=>'add',
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_add_url'=>Route('do_add_renter'),

        ];
        return view('admin.pages.forms.add_renter_user' ,$data);
    }


    public function saveRenterUser(Request $request){



        $profile_slug='';
        if(isset($request->profile_slug) && $request->profile_slug!=null){
            $profile_slug=\Helpers::make_slug($request->profile_slug);
        }

        $newRequest = new \Illuminate\Http\Request();
        $newRequest->replace([
            'mobile_number'=>$request->mobile_number,
            'email'=>$request->email,
            'password'=>$request->password,
            'fullname'=>$request->fullname,
            'avatar_dir' => $request->avatar_dir,
            'address'=>$request->address,
            'blog_title'=>$request->blog_title,
            'blog_description'=>$request->blog_description,
            'user_status'=>$request->user_status,
            'profile_slug'=>$profile_slug,
            'instagram_link'=>$request->instagram_link,
            'telegram_link'=>$request->telegram_link,
        ]);

        if ($newRequest->profile_slug!=Null && !preg_match('/^[a-zA-Z0-9]+$/',$newRequest->profile_slug)){
            return redirect()->back()
                ->withInput($request->input())
                ->with('messages',['آدرس پروفایل وارد شده معتبر نیست، آدرس باید شامل اعداد و یا حروف و یا هر دو آنها باشد']);
        }

        $validator = Validator::make($newRequest->all(),[
            'mobile_number'=>'required|digits:11|unique:renter_users,mobile_number',
            'email'=>'nullable|email|max:100',
            'password'=>'required|min:2|max:50',
            'fullname'=>'nullable|min:3|max:40',
            'avatar_dir' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'address'=>'max:500',
            'blog_title'=>'max:255',
            'blog_description'=>'max:2000',
            'user_status'=>'required|integer',
            'profile_slug'=>'max:30|unique:renter_users,profile_slug',
            'instagram_link'=>'max:100',
            'telegram_link'=>'max:100',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(['messages'=>$this->img_upload_error_msg]);
        }

        if($this->changeRenterUser($newRequest)){
            $msg=['کاربر جدید با موفقیت به وب سایت اضافه شد'];
        }else{

            goto validator_fails;
        }

        return redirect(url(Route('renter-user-list')))->with('messages', $msg);

    }




    public function editRenterUser(Request $request){

        if($request->id!=Null){
            $u=\App\Models\RenterUser::find($request->id);
            if($u==Null){ die('invalid request');}

            $title="ویرایش اطلاعات کاربر: ";
            $backward_url=Route('renter-user-list');
        }else{
            die('invalid request!');
        }

        $data=[
            'request_type'=>'edit',
            'u'=>$u,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('do_edit_renter'),
            'edit_id'=>$u->id,
        ];

        return view('admin.pages.forms.add_renter_user' ,$data);

    }



    public function doEditRenterUser(Request $request){
        $profile_slug='';
        if(isset($request->profile_slug) && $request->profile_slug!=null){
            $profile_slug=\Helpers::make_slug($request->profile_slug);
        }

        $newRequest = new \Illuminate\Http\Request();
        $newRequest->replace([
            'mobile_number'=>$request->mobile_number,
            'email'=>$request->email,
            'password'=>$request->password,
            'fullname'=>$request->fullname,
            'avatar_dir' => $request->avatar_dir,
            'address'=>$request->address,
            'blog_title'=>$request->blog_title,
            'blog_description'=>$request->blog_description,
            'user_status'=>$request->user_status,
            'profile_slug'=>$profile_slug,
            'instagram_link'=>$request->instagram_link,
            'telegram_link'=>$request->telegram_link,
            'edit_id'=>$request->edit_id,
        ]);

        if ($newRequest->profile_slug!=Null && !preg_match('/^[a-zA-Z0-9]+$/',$newRequest->profile_slug)){
            return redirect()->back()
                ->withInput($request->input())
                ->with('messages',['آدرس پروفایل وارد شده معتبر نیست، آدرس باید شامل اعداد و یا حروف و یا هر دو آنها باشد']);
        }



        $validator = Validator::make($newRequest->all(),[
            'edit_id'=>'required|integer|exists:renter_users,id',
            'mobile_number'=>'required|digits:11|unique:renter_users,mobile_number,'.$newRequest->edit_id,
            'email'=>'nullable|email|max:100',
            'password'=>'required|min:2|max:50',
            'fullname'=>'nullable|min:3|max:40',
            'avatar_dir' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'address'=>'max:500',
            'blog_title'=>'max:255',
            'blog_description'=>'max:2000',
            'user_status'=>'required|integer',
            'profile_slug'=>'max:30|unique:renter_users,profile_slug,'.$request->edit_id,
            'instagram_link'=>'max:100',
            'telegram_link'=>'max:100',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(['messages'=>$this->img_upload_error_msg]);;
        }


        if($this->changeRenterUser($newRequest)){
            $msg=['کاربر مورد نظر با موفقیت ویرایش شد'];
        }else{

            goto validator_fails;
        }

        return redirect(url(Route('renter-user-list')))->with('messages', $msg);

    }


    private function changeRenterUser($request){
        $uploaded_file_dir="";
        $this->img_upload_error_msg=array();
        $to_remove_dir="";

        try {
            if($request->avatar_dir!=Null) {

                $file = $request->avatar_dir;
                $fileName = "";

                if ($file == null) {
                    $fileName = "";
                } else {

                    if ($file->isValid()) {
                        $fileName = time() . $file->getClientOriginalName();
                        $destinationPath = public_path() . $this->fileUploadDir;
                        $imgConf=[
                            'imgType'=>'renterProfile',
                            'imgObject'=>$file,
                            'resultDir'=>$destinationPath.'/'.$fileName,
                        ];
                        \Helpers::save_img($imgConf['imgType'],$imgConf['imgObject'],$imgConf['resultDir']);
                        //$file->move($destinationPath, $fileName);
                        $uploaded_file_dir = $fileName;
                        if($request->edit_id!=Null) {
                            $to_remove_dir = \App\Models\RenterUser::find($request->edit_id)->avatar_dir;
                        }
                    } else {
                        $this->img_upload_error_msg = 'آپلود تصویر ناموفق بود';
                        goto catch_block;
                    }
                }
            }

            DB::transaction(function() use($request,$uploaded_file_dir,$to_remove_dir){
                if($request->edit_id!=Null) {
                    $u=\App\Models\RenterUser::find($request->edit_id);
                }else{
                    $u=new \App\Models\RenterUser();
                }

                $u->mobile_number=$request->mobile_number;
                if(trim($request->password)!="**||password-no-changed") {
                    $u->password = bcrypt($request->password);
                }
                $u->fullname=$request->fullname;
                if($uploaded_file_dir!=""){
                    $u->avatar_dir=$uploaded_file_dir;
                }
                $u->address=$request->address;
                $u->blog_title=$request->blog_title;
                $u->blog_description=nl2br($request->blog_description);
                $u->user_status=(int)$request->user_status;
                if($request->profile_slug!=Null && trim($request->profile_slug)!=''){
                    $u->profile_slug=$request->profile_slug;
                }
                $u->instagram_link=$request->instagram_link;
                $u->telegram_link=$request->telegram_link;

                $u->save();

                if($request->edit_id!=Null && $to_remove_dir!=""){
                    if(file_exists(public_path().$this->fileUploadDir.'/'.$to_remove_dir)){
                        unlink(public_path().$this->fileUploadDir.'/'.$to_remove_dir);
                    }
                }
            });

        }
        catch(Exception $e) {
            catch_block:
            if(file_exists(public_path().$this->fileUploadDir.'/'.$uploaded_file_dir)){
                unlink(public_path().$this->fileUploadDir.'/'.$uploaded_file_dir);
            }
            return false;
        }
        return true;
    }



    public function deleteRenterUser(Request $request){

        if(isset($request->remove_val)){
            foreach($request->remove_val as $c_id){
                $u=\App\Models\RenterUser::find($c_id);
                if($u!=Null && $u->avatar_dir!=null && trim($u->avatar_dir)!=''){
                    if(file_exists(public_path().$this->fileUploadDir.'/'.$u->avatar_dir)){
                        unlink(public_path().$this->fileUploadDir.'/'.$u->avatar_dir);
                    }
                }
                unset($u);
            }

            \App\Models\RenterUser::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];
        return redirect(url(Route('renter-user-list')))->with('messages', $msg);
    }
}

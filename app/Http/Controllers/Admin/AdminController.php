<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('admin.pages.dashboard');
    }


    public function showAdmins(Request $request){

        $admins=\App\Models\AdminUser::select('*')
            ->orderBy('user_status','DESC')
            ->orderBy('created_at','ASC')
            ->get();

        $title="لیست کاربران بخش مدیریت وب سایت";
        $backward_url=url('/admin/dashboard');
        $add_url=Route('add_admin_form');
        $del_url=Route('delete_admin_user');

        $resp=[
            'admins'=>$admins,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];

        return view('admin.pages.lists.admin_users' ,$resp);
    }


    public function showAddAdminForm(Request $request){

        $title="افزودن کاربر جدید به بخش مدیریت وب سایت";
        $backward_url=Route('admin-user-list');


        $data=[
            'request_type'=>'add',
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_add_url'=>Route('do_add_admin'),

        ];
        return view('admin.pages.forms.add_admin' ,$data);
    }






    public function saveAdmin(Request $request){


        $validator = Validator::make($request->all(),[
            'user_name'=>'required|min:3|max:100|unique:admin_users',
            'email'=>'nullable|email|max:100',
            'password'=>'required|min:4|max:40',
            'user_title'=>'required|min:3|max:40',
            'description'=>'max:1000',
            'user_status'=>'required|integer',
            'avatar_dir' => 'mimes:png,jpg,jpeg|max:1048',
        ]);



        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(['messages'=>$this->img_upload_error_msg]);;
        }



        if($this->changeAdminUser($request)){
            $msg=['کاربر جدید با موفقیت به بخش مدیریت وب سایت اضافه شد'];
        }else{

            goto validator_fails;
        }

        return redirect(url(Route('admin-user-list')))->with('messages', $msg);

    }





    private function changeAdminUser($request){
        $uploaded_file_dir="";
        $this->img_upload_error_msg=array();
        $to_remove_dir="";
        try {
            if($request->avatar_dir!=Null) {

                $file = $request->file('avatar_dir');
                $fileName = "";

                if ($file == null) {
                    $fileName = "";
                } else {

                    if ($file->isValid()) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $destinationPath = public_path() . '/admin/uploads/users';

                        $file->move($destinationPath, $fileName);
                        $uploaded_file_dir = $fileName;
                        if($request->edit_id!=Null) {
                            $to_remove_dir = \App\Models\AdminUser::find($request->edit_id)->avatar_dir;
                        }
                    } else {
                        $this->img_upload_error_msg = 'آپلود تصویر ناموفق بود';
                        goto catch_block;
                    }
                }

            }

            DB::transaction(function() use($request,$uploaded_file_dir,$to_remove_dir){
                if($request->edit_id!=Null) {
                    $u=\App\Models\AdminUser::find($request->edit_id);
                }else{
                    $u=new \App\Models\AdminUser();
                }

                $u->user_name=$request->user_name;
                $u->email=$request->email;
                if(trim($request->password)!="**||password-no-changed") {
                    $u->password = bcrypt($request->password);
                }
                $u->user_title=$request->user_title;
                if($uploaded_file_dir!=""){
                    $u->avatar_dir=$uploaded_file_dir;
                }
                $u->description=nl2br($request->description);
                $u->user_status=(int)$request->user_status;
                $u->save();

                if($request->edit_id!=Null && $to_remove_dir!=""){
                    if(file_exists(public_path().'/admin/uploads/users/'.$to_remove_dir)){
                        unlink(public_path().'/admin/uploads/users/'.$to_remove_dir);
                    }
                }
            });

        }
        catch(Exception $e) {
            catch_block:
            if(file_exists(public_path().'/admin/uploads/users/'.$uploaded_file_dir)){
                unlink(public_path().'/admin/uploads/users/'.$uploaded_file_dir);
            }
            return false;
        }
        return true;
    }





}

<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RenterUser;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
class UserController extends Controller
{

    var $fileUploadDir='/images/users/user-uploads/user-pics';
    public function showUser(){
        $user = RenterUser::where('id',Auth::guard('user')->user()->id)->first();
        $data=[
            'actionURL'=>Route('useraction'),
            'user'=>$user
        ];
        return view('user.panel.User',$data);
    }
    public function useraction(Request $request){

        if (!preg_match('/^[a-zA-Z0-9]+$/',$request->profile_slug)){
            return redirect()->back()
                ->withInput($request->input())
                ->with('data','آدرس پروفایل وارد شده معتبر نیست، آدرس باید شامل اعداد و یا حروف و یا هر دو آنها باشد');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'fullname'=>'required|max:255',
                'address'=>'required|max:500',
                'image' => 'mimes:png,jpg,jpeg|max:2048',
                'password'=>'required|min:4',
                'repassword'=>'required|min:4',
                'profile_slug'=>'required|max:30|unique:renter_users,profile_slug,'.Auth::guard('user')->user()->id,
            ]
        );
        if($request->password!=$request->repassword){
            $validation_errors="پسوردی که وارد کرده اید و تکرار آن با یکدیگر برابر نیستند";
            return redirect()->back()
                ->withInput($request->input())
                ->with('data',$validation_errors);
        }
        if($validator->fails()){

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        if($user->profile_slug == null) {
            $uniq = "این آدرس قبلا رزرو شده است";
            $url_count = RenterUser::where('profile_slug', $request->profile_slug)->get()->Count();
            if ($url_count > 0) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->with('uniq',$uniq);
            }
        }
        $uploaded_file_dir="";
        $removeimg = "";
        try {
            if($request->image != null){
                $file = $request->file('image');
                $fileName = "";

                if ($file == null) {
                    $fileName = "";
                }
                else {

                    if ($file->isValid()) {
                        $fileName = str_replace(' ', '', time()) . '.' . $file->guessClientExtension();
                        $destinationPath = public_path() . $this->fileUploadDir;
                        $imgConf=[
                            'imgType'=>'renterProfile',
                            'imgObject'=>$file,
                            'resultDir'=>$destinationPath.'/'.$fileName,
                        ];
                        \Helpers::save_img($imgConf['imgType'],$imgConf['imgObject'],$imgConf['resultDir']);
                        //$file->move(public_path('/images/users/user-uploads/user-pics'), $fileName);
                        $uploaded_file_dir = $fileName;
                        $removeimg = $user->avatar_dir;

                    }
                    else {
                        goto catch_block;
                    }
                }
            }
            DB::transaction(function() use($request,$uploaded_file_dir,$removeimg,$user){


                $user->fullname=$request->fullname;
                $user->address=$request->address;
                if($uploaded_file_dir!="") {
                    $user->avatar_dir = $uploaded_file_dir;
                }
                if(trim($request->password)!="**||password-no-changed") {
                    $user->password=bcrypt($request->password);
                }

                if ($user->profile_slug == null){

                    $user->profile_slug = $request->profile_slug;
                }
                $user->save();

                if($removeimg!=""){
                    if(file_exists(public_path().$this->fileUploadDir.'/'.$removeimg))
                        unlink(public_path().$this->fileUploadDir.'/'.$removeimg);
                }

            });
            return redirect('/User/Edit/')->with('data' , 'عملیات با موفقیت اجرا شد.');




        }
        catch(Exception $e) {
            catch_block:

            if(file_exists(public_path().$this->fileUploadDir.'/'.$uploaded_file_dir))
                unlink(public_path().$this->fileUploadDir.'/'.$uploaded_file_dir);

            return redirect()->back()->withInput($request->input())->with('data' , 'تصویر ارسالی مشکل دارد');

        }



    }
}

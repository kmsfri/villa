<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RenterUser;
use Illuminate\Support\Facades\Auth;
use Validator;
class GeneralController extends Controller
{
    public function showDashboard(){
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        return view('user.panel.master',['user'=>$user]);
    }
    public function showBlogconfig(){
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        $data=[
            'actionURL'=>route('blogaction'),
            'user'=>$user
        ];
        return view('user.panel.Blog',$data);
    }
    public function blogaction(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'blog_title'=>'required|max:255',
                'blog_description'=>'required',
            ]
        );

        if($validator->fails()){

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }
        $user = RenterUser::findorfail(Auth::guard('user')->user()->id);
        $user->blog_title = $request->blog_title;
        $user->blog_description = $request->blog_description;
        $user->instagram_link = $request->instagram_link;
        $user->telegram_link = $request->telegram_link;
        $user->save();
        return redirect('/User/Blog/')->with('data' , 'عملیات با موفقیت اجرا شد.');
    }

}

<?php

namespace App\Http\Controllers\users\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Villa;
use App\Models\Content;
use Validator;
use App\Models\NewsLetter;
use Auth;
class WebsiteGeneralController extends Controller
{
    public function newsletter_register(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'email'=>'required|max:100|email',
            ]
        );
        if($validator->fails()){

            echo "error";exit();
        }
        $email_exist = NewsLetter::where('email',$request->email)->get();
        if(count($email_exist)){
            echo "exist";exit();
        }
        $email = new NewsLetter();
        $email->email = $request->email;
        $email->save();
        echo "ok";
    }
    public function content_report(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'report_text'=>'required|max:280',
            ]
        );
        if($validator->fails()){

            echo "error";exit();
        }
        if (Auth::guard('user')->check()){
            $attach_data[$id] = [
                'content_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'report_text' => $request->report_text

            ];
            $content = Content::findorfail($id);
            $content->Reports()->attach($attach_data);
            echo "ok";
        }
        else{
            redirect()->route('showlogin');
        }
    }
    public function villa_report(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'report_text'=>'required|max:280',
            ]
        );
        if($validator->fails()){

            echo "error";exit();
        }
        if (Auth::guard('user')->check()){
            $attach_data[$id] = [
                'villa_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'report_text' => $request->report_text

            ];
            $villa = Villa::findorfail($id);
            $villa->Reports()->attach($attach_data);
            echo "ok";
        }
        else{
            redirect()->route('showlogin');
        }
    }
    public function rate_villa(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                's_type'=>'required|integer|between:0,6',
                's_value'=>'required|integer|between:1,5',
            ]
        );
        if($validator->fails()){

            echo "error";exit();
        }

        if (Auth::guard('user')->check()){
            $villa = Villa::findorfail($id);
            $attach_data[$id] = [
                'villa_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'score_type' => $request->s_type,
                'score_value' => $request->s_value,

            ];

                $villa->RenterUserScores()->wherePivot('score_type', $request->s_type)->sync($attach_data);

            echo "ok";
        }
        else{
            redirect()->route('showlogin');
        }
    }
    public function rate_content(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                's_value'=>'required|integer|between:1,5',
            ]
        );
        if($validator->fails()){

            echo "error";exit();
        }

        if (Auth::guard('user')->check()){
            $content = Content::findorfail($id);
            $attach_data[$id] = [
                'content_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'score_value' => $request->s_value,

            ];

            $content->RenterUserScores()->sync($attach_data);

            echo "ok";
        }
        else{
            redirect()->route('showlogin');
        }
    }
    public function rate_villa_list(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                's_value'=>'required|integer|between:1,5',
                'villa_id'=>'required|integer',
            ]
        );
        if($validator->fails()){

            echo "sssssssssserror";exit();
        }

        if (Auth::guard('user')->check()){
            $villa = Villa::findorfail($request->villa_id);
            $attach_data[$request->villa_id] = [
                'villa_id' => $request->villa_id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'score_type' => 0,
                'score_value' => $request->s_value,

            ];

            $villa->RenterUserScores()->wherePivot('score_type', 0)->sync($attach_data);

            echo "ok";
        }
        else{
            redirect()->route('showlogin');
        }
    }
}

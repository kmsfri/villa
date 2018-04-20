<?php

namespace App\Http\Controllers\users;

use App\Models\Villa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RenterUser;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\VillaVisit;
use App\Models\ContentVisit;
use App\Models\Content;
class GeneralController extends Controller
{
    public function showDashboard(){
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        $user_villas = Villa::where('renter_user_id',Auth::guard('user')->user()->id)->where('villa_status',1)->pluck('id')->toArray();
        $user_contents = Content::where('renter_user_id',Auth::guard('user')->user()->id)->where('content_status',1)->pluck('id')->toArray();
        $vtoday = VillaVisit::today_visits()->whereIN('villa_id',$user_villas)->count();
        $vlast24 = VillaVisit::last24_visits()->whereIN('villa_id',$user_villas)->count();
        $vweek = VillaVisit::lastWeek_visits()->whereIN('villa_id',$user_villas)->count();
        $villa_visit_table = VillaVisit::all()->whereIN('villa_id',$user_villas)->groupBy('villa_id');
        $content_visit_table = ContentVisit::all()->whereIN('content_id',$user_contents)->groupBy('content_id');
        $vmonth = VillaVisit::lastMonth_visits()->whereIN('villa_id',$user_villas)->count();
        $ctoday = ContentVisit::today_visits()->whereIN('content_id',$user_contents)->count();
        $clast24 = ContentVisit::last24_visits()->whereIN('content_id',$user_contents)->count();
        $cweek = ContentVisit::lastWeek_visits()->whereIN('content_id',$user_contents)->count();
        $cmonth = ContentVisit::lastMonth_visits()->whereIN('content_id',$user_contents)->count();
        return view('user.panel.Dashboard',['user'=>$user,
            'vtoday'=>$vtoday,
            'vlast24'=>$vlast24,
            'vweek'=>$vweek,
            'vmonth'=>$vmonth,
            'ctoday'=>$ctoday,
            'clast24'=>$clast24,
            'cweek'=>$cweek,
            'cmonth'=>$cmonth,
            'villa_visit_table'=>$villa_visit_table,
            'content_visit_table'=>$content_visit_table
            ]);
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
    public function villavisits($id){
        if (Auth::guard('user')->check()) {
            $v['today'] = VillaVisit::today_visits()->where('villa_id', $id)->count();
            $v['last24'] = VillaVisit::last24_visits()->where('villa_id', $id)->count();
            $v['week'] = VillaVisit::lastWeek_visits()->where('villa_id', $id)->count();
            $v['month'] = VillaVisit::lastMonth_visits()->where('villa_id', $id)->count();
            return response()->json($v);
        }
        else{
            echo "error";
        }
    }

}

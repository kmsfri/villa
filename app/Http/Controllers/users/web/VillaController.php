<?php

namespace App\Http\Controllers\users\web;

use App\Models\RenterUser;
use App\Models\VillaReserveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Villa;
use App\Models\VillaImage;
use App\Models\Property;
use App\Models\City;
use App\Models\Category1;
use App\Models\WebsiteComment;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Validator;
class VillaController extends Controller
{
    public function showSingleVilla(Request $request){

        $villa=$request->villa;
        $cities=array();
        $districts=array();
        //begin set seo tags
        $meta=(object)[
            'title'=>$villa->villa_title,
            'keywords'=>$villa->villa_slug,
            'description'=>$villa->villa_description,
        ];
        $canonical_url=urldecode(url(Route('showvilla',$villa->villa_slug)));
        $openGraph=(object)[
            'locale'=>'fa_IR',
            'type'=>'website',
            'title'=>$villa->villa_title,
            'description'=>$villa->villa_description,
            'url'=>urldecode(\URL::full()),
            'site_name'=>'ویلایار', //Config--
        ];
        if($villa->VillaImages()->count()>0){
            $openGraph->image=asset('tmp').'/'.$villa->VillaImages()->first()->image_dir;
        }
        $villaprop = $villa->Properties()->get();


        $properties=\App\Models\Property::where('parent_id',Null)
            ->where('prop_status',1)
            ->orderBy('prop_order','ASC')
            ->get();


        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $province_id = City::where('parent_id',$villa->Cities()->first()->province()->first()->id);
        $related_villas = Villa::related_villas($province_id->pluck('id')->toArray(),$villa->id);
        $related_contents = Content::related_contents($province_id->pluck('id')->toArray());
        $user = $villa->RenterUser()->first();
        return view('user.web.villa.singlevilla',[
            'cities'=>$cities,
            'districts'=>$districts,
            'states'=>$states,
            'villa'=>$villa,
            'meta'=>$meta,
            'openGraph'=>$openGraph,
            'canonical_url'=>$canonical_url,
            'villaprop'=>$villaprop,
            'properties'=>$properties,
            'related_villas'=>$related_villas,
            'contents'=>$related_contents,
            'user'=>$user,
            'cities'=>array(),
        ]);
        //end set seo tags
    }
    public function villa_comment(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'comment_text' => 'required|max:280',
            ]
        );

        if ($validator->fails()) {

            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors());

        }
        if (Auth::guard('user')->check()){
            $attach_data[$id] = [
                'villa_id' => $id,
                'renter_user_id' => Auth::guard('user')->user()->id,
                'comment_text' => $request->comment_text

            ];
            $villa = Villa::findorfail($id);
            $villa->Comments()->attach($attach_data);
            return redirect()->back()
                ->with('data','نظر شما با موفقیت ثبت شد، بعد از تایید مدیر نمایش داده می شود.');
        }
        else{
            return redirect(url('User/Login'));
        }
    }
    public function showallvillas(){

        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $cities=array();
        $districts=array();
        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();



        $villas = Villa::selectRaw('*, (villa.special_to >= CURRENT_TIMESTAMP) as is_special')
            ->where('villa_status',1)
            ->orderBy('is_special','DESC')
            ->orderBy('updated_at','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(12);
        $categories1 = Category1::where('category_status',1)->orderBy('category_order','ASC')->get();
        $websitecomments = WebsiteComment::where('comment_status',1)->orderBy('created_at','DESC')->get();
        $contents = Content::where('content_status',1)->where('is_draft',0)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->take(6)->get();

        return view('user.web.villa.villalist',[
           'states'=>$states,
           'cities'=>$cities,
           'districts'=>$districts,
           'villaTypes'=>$villaTypes,
           'villas'=> $villas,
           'categories1'=> $categories1,
           'websitecomments'=>$websitecomments,
           'contents'=>$contents
        ]);


    }
    public function villas_based_category1($slug){

        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $cities=array();
        $districts=array();
        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();


        $category1 = Category1::where('category_slug',$slug)
            ->where('category_status',1)
            ->first();
        if($category1==Null) abort(404);
        $villas = $category1->Villas()->where('villa_status',1)->orderBy('created_at','DESC')->paginate(12);
        $categories1 = Category1::where('category_status',1)->orderBy('category_order','ASC')->get();
        $contents = Content::where('content_status',1)->where('is_draft',0)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->take(6)->get();
        return view('user.web.villa.villaBaseCategory1',[
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'villaTypes'=>$villaTypes,
            'villas'=> $villas,
            'categories1'=>$categories1,
            'contents'=>$contents
        ]);


    }
    public function userpage($slug){
        $user = RenterUser::where('profile_slug',$slug)->first();
        $states = City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $villas = Villa::where('renter_user_id',$user->id)->where('villa_status',1)->orderBy('created_at','DESC')->paginate(12);
        $categories1 = Category1::where('category_status',1)->orderBy('category_order','ASC')->get();
        $websitecomments = WebsiteComment::where('comment_status',1)->orderBy('created_at','DESC')->get();
        $contents = Content::where('renter_user_id',$user->id)->where('show_in_body',1)->where('content_status',1)->where('is_draft',0)->orderBy('content_order','ASC')->orderBy('created_at','DESC')->take(6)->get();

        return view('user.web.villa.uservillalist',[
            'user'=>$user,
            'states'=>$states,
            'villas'=> $villas,
            'categories1'=> $categories1,
            'websitecomments'=>$websitecomments,
            'contents'=>$contents,
            'cities'=>array(),
        ]);

    }
    public function savewebsitecomment(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'websitecomment'=>'required|max:280',
            ]
        );
        if($validator->fails()){

            return redirect()->back()->with('errorcomment','<script>alert("ارسال نظر با مشکل مواجه شد، دوباره تلاش کنید");</script>');
        }
        if (Auth::guard('user')->check()){

            $websitecomment = new WebsiteComment();
            $websitecomment->comment_text = $request->websitecomment;
            $websitecomment->renter_user_id = Auth::guard('user')->user()->id;
            $websitecomment->save();
            return redirect()->back()
                ->with('errorcomment','<script>alert("نظر شما با موفقیت ثبت شد، بعد از تایید مدیر نمایش داده می شود.");</script>');
        }
        else{
            return redirect(url('User/Login'));
        }
    }
    public function reserve_request(Request $request , $id){
        $validator = Validator::make(
            $request->all(),
            [
                'fullname'=>'required|max:200',
                'phone'=>'required|digits:11',
                'date_in'=>['regex:/\d{4}-\d{2}-\d{2}$/'],
                'date_out'=>['regex:/\d{4}-\d{2}-\d{2}$/'],
                'pc'=>'integer',
            ]
        );
        if($validator->fails()){

            echo "error";exit();
        }
        $reserve = new VillaReserveRequest();
        $reserve->date_in = \Helpers::convert_date_j_to_g($request->date_in,'/');
        $reserve->date_out = \Helpers::convert_date_j_to_g($request->date_out,'/');
        $reserve->people_count = $request->pc;
        $reserve->fullname = $request->fullname;
        $reserve->phone = $request->phone;
        $reserve->villa_id = $id;
        $reserve->save();
        \Helpers::send_reserve_villa_sms(Villa::find($id)->RenterUser()->first()->mobile_number);
        echo "ok";
    }






    public function search(Request $request){

        $search=(object)array();


        if(isset($request->villa_code) && $request->villa_code!=Null){
            $search->villa_code = $request->villa_code;
            $villas=Villa::selectRaw('*, (villa.special_to >= CURRENT_TIMESTAMP) as is_special')
                ->where('id',$request->villa_code)
                ->where('villa_status',1);
        }else {
            $villas = Villa::selectRaw('villa.*, villa.created_at as created_at, villa.updated_at as updated_at, (villa.special_to >= CURRENT_TIMESTAMP) as is_special')
                ->where('villa_status', 1);


            $city_id = array();
            if (isset($request->district) && $request->district != Null) {
                $search->district = $request->district;
                $search->city = $request->city;
                $search->state = $request->state;

                $city_id[] = $request->district;
            } elseif (isset($request->city) && $request->city != Null) {
                $search->city = $request->city;
                $search->state = $request->state;

                $districts = \App\Models\City::select('id')
                    ->where('parent_id', $request->city)
                    ->where('city_status', 1)
                    ->get();
                $city_id = $districts->pluck('id')->toArray();
                $city_id[] = $request->city;
            } elseif (isset($request->state) && $request->state != Null) {
                $search->state = $request->state;

                $cities = \App\Models\City::select('id')
                    ->where('parent_id', $request->state)
                    ->where('city_status', 1)
                    ->get();
                $city_id = $cities->pluck('id')->toArray();

                $districts = \App\Models\City::select('id')
                    ->whereIn('parent_id', $city_id)
                    ->where('city_status', 1)
                    ->get();

                $city_id = array_merge($city_id, $districts->pluck('id')->toArray());

                $city_id[] = $request->state;
            }

            if (count($city_id) > 0) {
                $villas = $villas->join('villa_city', function ($join) use ($city_id) {
                    $join->on('villa_id', '=', 'villa.id')
                        ->whereIn('city_id', $city_id);
                });
            }


            if (isset($request->villaTypes) && $request->villaTypes != Null) {
                $search->villaTypes = $request->villaTypes;
                $villas = $villas->where('villa_type_id', (int)$request->villaTypes);
            }

            if (isset($request->standard_capacity) && $request->standard_capacity != Null) {
                $search->standard_capacity = $request->standard_capacity;
                $villas = $villas->where('standard_capacity', $request->standard_capacity);
            }

            if (isset($request->bedroom_count) && $request->bedroom_count != Null) {
                $search->bedroom_count = $request->bedroom_count;
                $villas = $villas->where('bedroom_count', $request->bedroom_count);
            }

            if (isset($request->rent_day) && $request->rent_day != Null) {

                $search->rent_day = $request->rent_day;

                $price_field_name = [
                    'midweek' => 'midweek_price',
                    'lastweek' => 'lastweek_price',
                    'peaktime' => 'peaktime_price'
                ];

                $villas = $villas->where($price_field_name[$request->rent_day], '<=', (int)$request->price_to_search);


            } elseif (isset($request->price_to_search) && $request->price_to_search != Null) {
                $search->price_to_search = $request->price_to_search;

                $villas = $villas->where('rent_daily_price_from', '<=', (int)$request->price_to_search);
            }
        }


            $villas = $villas->orderBy('is_special', 'DESC')
                ->orderBy('villa.updated_at', 'DESC')
                ->orderBy('villa.created_at', 'DESC')
                ->paginate(12);











        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();
        $categories1 = Category1::where('category_status',1)->orderBy('category_order','ASC')->get();



        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
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
        if($request->city!=Null){
            if(\App\Models\City::find($request->city)!=Null){
                $districts=\App\Models\City::selectRaw('id , city_name')
                    ->where('parent_id','=',$request->city)
                    ->where('city_status','=',1)
                    ->orderBy('city_order' , 'ASC')
                    ->orderBy('created_at')
                    ->get();
            }else{
                $districts=array();
            }
        }else{
            $districts=array();
        }





        return view('user.web.villa.villaSearch',[
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'villaTypes'=>$villaTypes,
            'villas'=> $villas,
            'search'=>$search,
            'categories1'=> $categories1,
        ]);








    }


}

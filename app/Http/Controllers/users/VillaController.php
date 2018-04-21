<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\RenterUser;
use \App\Models\Villa;
use \App\Models\VillaImage;
use \App\Models\Tariff;
use Auth;
use Validator;
use DB;
class VillaController extends Controller
{
    public function showVillaList(Request $request){
        $user = RenterUser::find(Auth::guard('user')->user()->id);
        $add_url=Route('addVillaForm');
        $villas = $user->Villas()
            ->selectRaw('*, (villa.special_to >= CURRENT_TIMESTAMP) as is_special,(villa.updated_at+INTERVAL '.'60'.' MINUTE >= CURRENT_TIMESTAMP) as updated'); //--Config ex. 60 minute - yani bad az chand daghighe waziatash beroozresani nashode neshan dade shawad

        if(isset($request->villa_type) && $request->villa_type!=Null){
            $villas=$villas->where('villa_type_id',$request->villa_type);
        }
        $villas=$villas->orderBy('villa.updated_at','DESC')->orderBy('villa.created_at','ASC')->paginate(10);


        $tariffs=Tariff::where('tariff_status',1)
            ->orderBy('tariff_duration','ASC')
            ->orderBy('created_at','DESC')
            ->get();


        $data=[
            'user'=>$user,
            'villas'=>$villas,
            'tariffs'=>$tariffs,
        ];
        return view('user.panel.VillaList',$data);
    }

    public function addVilla(Request $request){


        $renter_user = Auth::guard('user')->user();

        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $cities=array();
        $districts=array();
        $properties=\App\Models\Property::where('parent_id',Null)
            ->where('prop_status',1)
            ->orderBy('prop_order','ASC')
            ->get();


        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();

        $data=[
            'user'=>$renter_user,
            'actionURL'=>Route('doSaveVilla'),
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'properties'=>$properties,
            'villaTypes'=>$villaTypes,
        ];
        return view('user.panel.addVilla',$data);
    }


    public function editVilla($id){
        $villa = Villa::where('id',$id)
            ->where('renter_user_id',Auth::guard('user')->user()->id)
            ->first();
        if(empty($villa))abort(404);

        $villa_city_parent1=Null;
        $villa_city_parent2=Null;
        if($villa->Cities()->count()>0) {
            $villa_city_parent1 = $villa->Cities()->first()->province()->first();
            if($villa_city_parent1!=Null) {
                $villa_city_parent2 = $villa_city_parent1->province()->first();
            }
        }


        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $cities=array();
        $districts=array();
        if($villa_city_parent1==Null){//Villa city id is a Province
            $selected_province=$villa->Cities()->first();
            $selected_city=Null;
            $selected_district=Null;

            $cities=array();
            if($selected_province!=Null){
                $cities=\App\Models\City::selectRaw('id , city_name')
                    ->where('parent_id','=',$selected_province->id)
                    ->where('city_status','=',1)
                    ->orderBy('city_order' , 'ASC')
                    ->orderBy('created_at')
                    ->get();
            }

        }elseif($villa_city_parent2==Null) {//Villa city id is a City
            $selected_province=$villa->Cities()->first()->Province()->first();
            $selected_city=$villa->Cities()->first();
            $selected_district=Null;

        }else{//Villa city id is a district
            $selected_province=$villa->Cities()->first()->Province()->first()->Province()->first();
            $selected_city=$villa->Cities()->first()->Province()->first();
            $selected_district=$villa->Cities()->first();

        }


        if($selected_province!=Null){
            $cities=\App\Models\City::selectRaw('id , city_name')
                ->where('parent_id','=',$selected_province->id)
                ->where('city_status','=',1)
                ->orderBy('city_order' , 'ASC')
                ->orderBy('created_at')
                ->get();
        }

        if($selected_city!=Null){
            $districts=\App\Models\City::selectRaw('id , city_name')
                ->where('parent_id','=',$selected_city->id)
                ->where('city_status','=',1)
                ->orderBy('city_order' , 'ASC')
                ->orderBy('created_at')
                ->get();
        }


        if($selected_province==Null){
            $villa->province=Null;
        }else{
            $villa->province=$selected_province->id;
        }

        if($selected_city==Null){
            $villa->city_id=Null;
        }else{
            $villa->city_id=$selected_city->id;
        }

        if($selected_district==Null){
            $villa->district=Null;
        }else{
            $villa->district=$selected_district->id;
        }


        $properties=\App\Models\Property::where('parent_id',Null)
            ->where('prop_status',1)
            ->orderBy('prop_order','ASC')
            ->get();

        $renter_user = Auth::guard('user')->user();

        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();

        $data=[
            'user'=>$renter_user,
            'actionURL'=>Route('doSaveVilla'),
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'properties'=>$properties,
            'villa'=>$villa,
            'edit_id'=>$villa->id,
            'villaTypes'=>$villaTypes,
        ];
        return view('user.panel.addVilla',$data);


    }




    var $uplaod_dir='/images/users/user-uploads/user-villa/';
    public function doSaveVilla(Request $request){
        $villa_slug=Null;
        if(isset($request->villa_title) && $request->villa_title!=null){
            $villa_slug = \Helpers::make_slug($request->villa_title);
        }

        $newRequest = new \Illuminate\Http\Request();
        $newRequest->replace([
            'newImg.*' => $request->newImg,
            'oldImg.*' => $request->oldImg,
            'villa_title'=>$request->villa_title,
            'state'=>$request->state,
            'city'=>$request->city,
            'district'=>$request->district,
            'land_area'=>$request->land_area,
            'building_area'=>$request->building_area,
            'foundation_area'=>$request->foundation_area,
            'floor_count'=>$request->floor_count,
            'bedroom_count'=>$request->bedroom_count,
            'bed_count'=>$request->bed_count,
            'sea_distance_by_car'=>$request->sea_distance_by_car,
            'sea_distance_walking'=>$request->sea_distance_walking,
            'rent_daily_price_from'=>$request->rent_daily_price_from,
            'midweek_price'=>$request->midweek_price,
            'lastweek_price'=>$request->lastweek_price,
            'peaktime_price'=>$request->peaktime_price,
            'price_description'=>nl2br($request->price_description),
            'standard_capacity'=>$request->standard_capacity,
            'bathroom_count'=>$request->bathroom_count,
            'max_capacity'=>$request->max_capacity,
            'wc_count'=>$request->wc_count,
            'propDesc'=>$request->propDesc,
            'props'=>$request->props,
            'propCheck'=>$request->propCheck,
            'propText'=>$request->propText,
            'villa_description'=>nl2br($request->villa_description),
            'villa_address'=>nl2br($request->villa_address),
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'villa_slug'=>$villa_slug,
            'villa_type_id'=>$request->villa_type_id,
        ]);



        $validator = Validator::make(
            $newRequest->all(),
            [
                'newImg.*' => 'mimes:png,jpg,jpeg|max:2048',
                'oldImg.*' => 'integer|exists:villa_images,id',
                'villa_title'=>'required|max:255',
                'state'=>'required|integer|exists:cities,id',
                'city'=>'nullable|integer|exists:cities,id',
                'district'=>'nullable|integer|exists:cities,id',
                'land_area'=>'required|integer',
                'building_area'=>'required|integer',
                'foundation_area'=>'required|integer',
                'floor_count'=>'required|integer',
                'bedroom_count'=>'required|integer',
                'bed_count'=>'required|integer',
                'sea_distance_by_car'=>'max:40',
                'sea_distance_walking'=>'max:40',
                'rent_daily_price_from'=>'nullable|max:20',
                'midweek_price'=>'nullable|max:20',
                'lastweek_price'=>'nullable|max:20',
                'peaktime_price'=>'nullable|max:20',
                'price_description'=>'nullable|max:280',
                'standard_capacity'=>'nullable|integer',
                'bathroom_count'=>'nullable|integer',
                'max_capacity'=>'nullable|integer',
                'wc_count'=>'nullable|integer',
                'propDesc.*'=>'nullable|max:1000',
                'props.*'=>'nullable|integer',
                'propCheck.*'=>'nullable|integer',
                'propText.*'=>'nullable|max:140',
                'villa_description'=>'required|max:500',
                'villa_address'=>'required|max:255',
                'latitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'longitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'villa_slug'=>'required|max:30|unique:villa,villa_slug,'.$request->edit_id,
                'villa_type_id'=>'nullable|integer|exists:villa_type,id'
            ]
        );







        if($validator->fails() || ($request->newImg==Null && $request->oldImg==Null)){

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


            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید')
                ->with(['cities'=>$cities,'districts'=>$districts]);
        }





        if(isset($request->edit_id) && $request->edit_id!=Null) {

            $villa = Villa::where('id', $request->edit_id)
                ->where('renter_user_id', Auth::guard('user')->user()->id)
                ->first();
            if ($villa == Null) abort(404);
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
                            $fileName = Auth::guard('user')->user()->id.str_replace(' ', '', time()).rand(1000,9999). '.' . $file->guessClientExtension();
                            $destinationPath =  $this->uplaod_dir;
                            $imgConf=[
                                'imgType'=>'blogImage',
                                'imgObject'=>$file,
                                'resultDir'=>public_path().$destinationPath.'/'.$fileName,
                            ];
                            \Helpers::save_img($imgConf['imgType'],$imgConf['imgObject'],$imgConf['resultDir']);
                            //$file->move($destinationPath, $fileName);
                            $uploaded_files_dir[] = $destinationPath.'/'.$fileName;
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

                foreach($villa->VillaImages()->get() as $cimg){
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
                $villa=new Villa();
                $villa->renter_user_id=Auth::guard('user')->user()->id;
            }


            DB::transaction(function() use($newRequest,$request,$uploaded_files_dir,$removableOldImgID,$removableOldImgDir,$villa,$villa_slug){


                $villa->villa_type_id=$newRequest->villa_type_id;
                $villa->villa_title=$newRequest->villa_title;
                $villa->villa_slug=$newRequest->villa_slug;
                $villa->villa_description=$newRequest->villa_description;
                $villa->villa_short_description=mb_substr($newRequest->villa_description,0,130);
                $villa->villa_address=$newRequest->villa_address;
                $villa->land_area=$newRequest->land_area;
                $villa->court_area=$newRequest->court_area;
                $villa->building_area=$newRequest->building_area;
                $villa->foundation_area=$newRequest->foundation_area;
                $villa->floor_count=$newRequest->floor_count;
                $villa->bedroom_count=$newRequest->bedroom_count;
                $villa->bed_count=$newRequest->bed_count;
                $villa->sea_distance_by_car=$newRequest->sea_distance_by_car;
                $villa->sea_distance_walking=$newRequest->sea_distance_walking;
                $villa->standard_capacity=$newRequest->standard_capacity;
                $villa->max_capacity=$newRequest->max_capacity;
                $villa->foundation_area=$newRequest->foundation_area;
                $villa->wc_count=$newRequest->wc_count;
                $villa->bathroom_count=$newRequest->bathroom_count;
                $villa->rent_daily_price_from=$newRequest->rent_daily_price_from;
                $villa->midweek_price=$newRequest->midweek_price;
                $villa->lastweek_price=$newRequest->lastweek_price;
                $villa->peaktime_price=$newRequest->peaktime_price;
                $villa->price_description=$newRequest->price_description;
                if ($newRequest->latitude != null) {
                    $villa->latitude = $newRequest->latitude;
                }
                if ($newRequest->longitude != null) {
                    $villa->longitude = $newRequest->longitude;
                }
                $villa->villa_status=0;

                $villa->save();


                $img_data=array();
                foreach($uploaded_files_dir as $key=>$ufd){
                    $img_data[]=new VillaImage([
                        'villa_id'=>$villa->id,
                        'image_dir'=>$ufd,
                        'image_order'=>$key,
                    ]);
                }

                $villa->VillaImages()->whereIn('id',$removableOldImgID)->delete();

                $villa->VillaImages()->saveMany($img_data);

                if($newRequest->district!=Null){
                    $villa->Cities()->sync($newRequest->district);
                }elseif($newRequest->city!=Null){
                    $villa->Cities()->sync($newRequest->city);

                }elseif($newRequest->state!=Null){
                    $villa->Cities()->sync($newRequest->state);
                }


                $props=array();
                if($newRequest->propDesc!=Null){
                    foreach($newRequest->propDesc as $key=>$pD){
                        if($pD!=Null && $pD!='' && $key!=Null){
                            $props[$key]=['text_value'=>$pD];
                        }
                    }
                }

                if($newRequest->props!=Null) {
                    foreach ($newRequest->props as $pr) {
                        if ($pr != Null) {
                            $props[$pr] = [];
                        }
                    }
                }



                if($newRequest->propCheck!=Null) {
                    foreach ($newRequest->propCheck as $key => $pC) {
                        if ($key != Null) {
                            $props[$key] = ['text_value' => $newRequest->propText[$key]];
                        }
                    }
                }



                $villa->Properties()->sync($props);


                if($request->edit_id!=Null){
                    foreach($removableOldImgDir as $uimg_dir){
                        if(file_exists(public_path().$uimg_dir)){
                            unlink(public_path().$uimg_dir);
                        }
                    }
                }

            });

        }
        catch(Exception $e) {
            catch_block:
            foreach($uploaded_files_dir as $uimg_dir){
                if(file_exists(public_path().$uimg_dir)){
                    unlink(public_path().$uimg_dir);
                }
            }
            return redirect()->back()
                ->withInput($request->input())
                ->with('data','عملیات با شکست مواجه شد، دوباره تلاش کنید');

        }

        if(isset($request->edit_id) && $request->edit_id!=Null){
            $msg="مطلب مورد نظر با موفقیت ویرایش شد";
        }else{
            $msg="مطلب جدید با موفقیت اضافه شد";
        }
        return redirect(url(Route('editVillaCategory',$villa->id)))->with('data', $msg);
    }




    public function editVillaCategory(Request $request){

        $villa=Villa::where('id',$request->villa_id)
            ->where('renter_user_id',Auth::guard('user')->user()->id)
            ->first();

        if($villa==Null) abort(404);

        $masterCtgs=\App\Models\Category1::where('category_status',1)
            ->where('parent_id',Null)
            ->orderBy('category_order','ASC')
            ->orderBy('created_at','DESC')
            ->get();






        $data=[
            'user'=>Auth::guard('user')->user(),
            'actionURL'=>Route('doEditVillaCategory'),
            'masterCtgs'=>$masterCtgs,
            'villa'=>$villa,
            'edit_id'=>$villa->id,

        ];

        return view('user.panel.selectVillaCategory',$data);


    }


    public function doEditVillaCategory(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'ctg.*' => 'integer|exists:categories1,id',
                'edit_id'=>'required|exists:villa,id',
            ]
        );



        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }





        $villa=Villa::where('id',$request->edit_id)
            ->where('renter_user_id',Auth::guard('user')->user()->id)
            ->first();
        if($villa==Null) abort(404);


        $villa->Categories1()->sync($request->ctg);


        $msg='دسته بندی مورد نظر با موفقیت بروزرسانی شد';
        return redirect(url(Route('villaList')))->with('data', $msg);


    }



    public function specializeVilla(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'villa_id_to_specialize'=>'required|integer|exists:villa,id',
                'tariffID'=>'required|integer|exists:tariffs,id',
                'payType'=>'required|integer'
            ]
        );

        if($validator->fails()){
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','ورودی های خود را بررسی کنید');
        }

        $villa=Villa::findOrFail($request->villa_id_to_specialize);
        $user=Auth::guard('user')->user();
        $tariff=Tariff::where('id',$request->tariffID)->where('tariff_status',1)->first();
        if($tariff==Null) abort(404);

        if($request->payType==1) { //pay from points
            if ($tariff->tariff_needed_points > $user->points) {
                return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validator->errors())
                    ->with('data', 'شما امتیاز کافی برای اینکار ندارید. لطفا یا از روش پرداخت دیگری استفاده کنید و یا تعرفه ی دیگری را انتخاب نمایید.');
            }


            DB::transaction(function () use ($villa, $tariff, $user) {

                $user->points -= $tariff->tariff_needed_points;
                $user->save();

                $user->BoutghtTariffs()->attach([
                    $tariff->id => [
                        'paid_status' => 1,
                        'paid_amount' => $tariff->tariff_needed_points,
                        'paid_from' => 1,
                        'pay_time' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                ]);


                $current = \Carbon\Carbon::now();
                $expire_date = $current->addDays($tariff->tariff_duration)->toDateTimeString();

                $villa->special_to = $expire_date;
                $villa->save();


            });

            return redirect(url(Route('villaList')))->with('data', 'ویلای مورد نظر با موفقیت ویژه شد');

        }else{
            //go to payment gateway
        }



    }








    public function updateVilla(Request $request){
        if(isset($request->villa_id) && $request->villa_id!=Null){
            $villa=Villa::selectRaw('*,(villa.updated_at+INTERVAL '.'60'.' MINUTE >= CURRENT_TIMESTAMP) as updated') //--Config ex. 60 minute; har chand daghighe 1 bar ghabeliate beroozresani dashte bashad
            ->where('id',$request->villa_id)->first();



            if($villa->updated==1) return redirect(url(Route('villaList')))->with('data', 'شما هر  '.'60'.' دقیقه یکبار میتوانید ویلای خود را بروزرسانی کنید'); //--Config - haman balayi

            if($villa==Null)abort(404);

            if($villa->villa_status!=1) return redirect(url(Route('villaList')))->with('data', 'ویلای تایید نشده قابلیت بروزرسانی ندارد');

            $villa->touch();


        }else{
            abort(404);
        }


        return redirect(url(Route('villaList')))->with('data', 'ویلای مورد نظر با موفقیت بروزرسانی شد');

    }









}

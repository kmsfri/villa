<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Villa;
use \App\Models\VillaImage;
use \App\Models\VillaType;
use App\Models\UserVillaComments;
use Validator;
use DB;
use Auth;
class VillaController extends Controller
{
    public function showVillaList(Request $request){
        $add_url=Null;
        if(isset($request->user_id)){
            if(($renter_user=\App\Models\RenterUser::find($request->user_id))==Null) abort(404);
            $add_url=Route('adminAddVillaForm',$request->user_id);

            $villas = $renter_user->Villas()->orderBy('villa.updated_at','DESC')->orderBy('villa.created_at','ASC')->paginate(10);

        }else{
            $villas = Villa::orderBy('updated_at','DESC')->orderBy('created_at','ASC')->paginate(10);
        }

        $data=[
            'title'=>'لیست ویلاهای ثبت شده در وبسایت',
            'add_url'=>$add_url,
            'del_url'=>Route('adminRemoveVilla'),
            'villas'=>$villas,
        ];
        return view('admin.pages.lists.villas',$data);


    }

    public function addVilla(Request $request){


        $renter_user=\App\Models\RenterUser::findOrFail($request->renter_user_id);

        $states = \App\Models\City::where('parent_id',null)->where('city_status',1)->orderBy('city_order','ASC')->get();
        $cities=array();
        $districts=array();
        $properties=\App\Models\Property::where('parent_id',Null)
            ->where('prop_status',1)
            ->orderBy('prop_order','ASC')
            ->get();


        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();


        $data=[
            'title'=>'افزودن اقامتگاه جدید',
            'request_type'=>'add',
            'post_add_url'=>Route('adminDoSaveVilla'),
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'properties'=>$properties,
            'renter_user_id'=>$renter_user->id,
            'villaTypes'=>$villaTypes,
        ];
        return view('admin.pages.forms.add_villa',$data);
    }


    public function editVilla($id){
        $villa = Villa::where('id',$id)->first();
        if(empty($villa))die('invalid_request!');

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

        $villaTypes=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();

        $data=[
            'title'=>'ویرایش اطلاعات ویلا',
            'request_type'=>'edit',
            'post_edit_url'=>Route('adminDoSaveVilla'),
            'states'=>$states,
            'cities'=>$cities,
            'villa'=>$villa,
            'districts'=>$districts,
            'properties'=>$properties,
            'edit_id'=>$villa->id,
            'villaTypes'=>$villaTypes,
        ];





        return view('admin.pages.forms.add_villa',$data);
    }




    var $uplaod_dir='/images/users/user-uploads/user-villa/';
    public function doSaveVilla(Request $request){





        $villa_slug=Null;
        if(isset($request->villa_title) && $request->villa_title!=null){
            $villa_slug = \Helpers::make_slug($request->villa_title);
        }


        $newRequest = new \Illuminate\Http\Request();
        $newRequest->replace([
            'renter_user_id' => $request->renter_user_id,
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
            'villa_status'=>$request->villa_status,
            'villa_slug'=>$villa_slug,
            'villa_type_id'=>$request->villa_type_id,
        ]);



        $validator = Validator::make(
            $newRequest->all(),
            [
                'renter_user_id'=>'nullable|integer|exists:renter_users,id',
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
                'propDesc.*'=>'nullable|max:255',
                'props.*'=>'nullable|integer',
                'propCheck.*'=>'nullable|integer',
                'propText.*'=>'nullable|max:140',
                'villa_description'=>'required|max:500',
                'villa_address'=>'required|max:255',
                'latitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'longitude'=>['nullable', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
                'villa_status'=>'required|integer',
                'villa_slug'=>'required|max:30|unique:villa,villa_slug,'.$request->edit_id,
                'villa_type_id'=>'nullable|integer|exists:villa_type,id'
            ]
        );







        if($validator->fails()){

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
                ->with('messages',['ورودی های خود را بررسی کنید'])
                ->with(['cities'=>$cities,'districts'=>$districts]);
        }



        if((!isset($request->edit_id) || $request->edit_id==Null) && $request->renter_user_id==Null) abort(404);



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
                            $fileName = Auth::guard('admin')->user()->id.str_replace(' ', '', time()).rand(1000,9999). '.' . $file->guessClientExtension();
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

                $villa=Villa::where('id',$request->edit_id)->first();
                if($villa==Null)die('invalid_request!');

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
                $villa->renter_user_id=$request->renter_user_id;
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
                $villa->villa_status=$newRequest->villa_status;

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
                foreach($newRequest->propDesc as $key=>$pD){
                    if($pD!=Null && $pD!='' && $key!=Null){
                        $props[$key]=['text_value'=>$pD];
                    }
                }
                foreach($newRequest->props as $pr){
                    if($pr!=Null){
                        $props[$pr]=[];
                    }
                }

                foreach($newRequest->propCheck as $key=>$pC){
                    if($key!=Null) {
                        $props[$key] = ['text_value' => $newRequest->propText[$key]];
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
                ->with('messages',['عملیات با شکست مواجه شد، دوباره تلاش کنید']);

        }

        if(isset($request->edit_id) && $request->edit_id!=Null){
            $msg=["مطلب مورد نظر با موفقیت ویرایش شد"];
        }else{
            $msg=["مطلب جدید با موفقیت اضافه شد"];
        }
        return redirect(url(Route('adminEditVillaCategory',$villa->id)))->with('messages', $msg);
    }




    public function editVillaCategory(Request $request){

        $villa=Villa::where('id',$request->villa_id)
            ->first();
        if($villa==Null)die('invalid request!');

        $masterCtgs=\App\Models\Category1::where('category_status',1)
            ->where('parent_id',Null)
            ->orderBy('category_order','ASC')
            ->orderBy('created_at','DESC')
            ->get();



        $data=[
            'title'=>'انتخاب دسته بندی',
            'request_type'=>'edit',
            'post_edit_url'=>Route('adminDoEditVillaCategory'),
            'masterCtgs'=>$masterCtgs,
            'villa'=>$villa,
            'edit_id'=>$villa->id,
        ];

        return view('admin.pages.forms.SelectVillaCategory',$data);


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
                ->with('messages',['ورودی های خود را بررسی کنید']);
        }





        $villa=Villa::where('id',$request->edit_id)
            ->first();
        if($villa==Null)die('invalid request!');


        $villa->Categories1()->sync($request->ctg);


        $msg=['دسته بندی مطلب مورد نظر با موفقیت بروزرسانی شد'];
        return redirect(url(Route('adminShowVillaList')))->with('messages', $msg);


    }


    public function doRemoveVilla(Request $request){
        if(isset($request->remove_val)){
            \App\Models\Villa::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminShowVillaList')))->with('messages', $msg);
    }
















    public function villaTypes(){




        $villaTypes=VillaType::select('*')
            ->orderBy('villa_type_order','ASC')
            ->orderBy('created_at','DESC')->get();

        $title="لیست نوع ویلاهای تعریف شده";
        $backward_url=Route('dashboard');
        $add_url=Route('doAddVillaType');
        $del_url=Route('doDeleteVillaType');

        $resp=[
            'villaTypes'=>$villaTypes,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];

        return view('admin.pages.lists.villa_types' ,$resp);
    }


    public function showAddVillaTypeForm(Request $request){

        $title="افزودن نوع ویلای جدید";
        $backward_url=Route('adminVillaTypeList');

        $data=[
            'request_type'=>'add',
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_add_url'=>Route('doAddVillaType'),

        ];
        return view('admin.pages.forms.add_villa_type' ,$data);
    }


    public function saveVillaType(Request $request){

        $validator = Validator::make($request->all(),[
            'villa_type_title'=>'required|max:80',
            'villa_type_order'=>'required|integer',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if($this->changeVillaType($request)){
            $msg=['نوع ویلای جدید با موفقیت اضافه شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminVillaTypeList')))->with('messages', $msg);

    }




    public function editVillaType(Request $request){
        if($request->id!=Null){
            $villaType=VillaType::find($request->id);
            if($villaType==Null) abort(404);
            $title="ویرایش نوع ویلا ";
            $backward_url=Route('adminVillaTypeList');
        }else{
            abort(404);
        }


        $data=[
            'request_type'=>'edit',
            'villaType'=>$villaType,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('doEditVillaType'),
            'edit_id'=>$villaType->id,
        ];

        return view('admin.pages.forms.add_villa_type' ,$data);

    }



    public function doEditVillaType(Request $request){

        $validator = Validator::make($request->all(),[
            'villa_type_title'=>'required|max:80',
            'villa_type_order'=>'required|integer',
            'edit_id'=>'required|integer|exists:villa_type,id',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if($this->changeVillaType($request)){
            $msg=['نوع ویلای مورد نظر با موفقیت ویرایش شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminVillaTypeList')))->with('messages', $msg);

    }


    private function changeVillaType($request){
        if($request->edit_id!=Null) {
            $villaType=VillaType::find($request->edit_id);
        }else{
            $villaType=new VillaType();
        }

        $villaType->villa_type_title=$request->villa_type_title;
        $villaType->villa_type_order=$request->villa_type_order;

        $villaType->save();

        return True;

    }



    public function deleteVillaType(Request $request){

        if(isset($request->remove_val)){
            VillaType::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminVillaTypeList')))->with('messages', $msg);
    }



























    public function Comments(Request $request){

        if(isset($request->villa_id) && $request->villa_id!=Null){
            $villa=Villa::find($request->villa_id);
            if($villa==Null) abort(404);

            $comments=UserVillaComments::where('villa_id',$villa->id)
                ->orderBy('created_at','DESC')
                ->orderBy('updated_at','DESC')
                ->get();

            $title="نظرات ویلای: ".$villa->villa_title;

        }else{
            $comments=UserVillaComments::orderBy('created_at','DESC')
                ->orderBy('updated_at','DESC')
                ->get();
            $title="نظرات ثبت شده برای ویلاها";
        }

        $backward_url=Route('dashboard');
        $add_url=Null;
        $del_url=Route('doDeleteVillaComment');

        $resp=[
            'comments'=>$comments,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];



        return view('admin.pages.lists.villaComments' ,$resp);
    }


    public function editComment(Request $request){
        if($request->id!=Null){
            $comment=UserVillaComments::find($request->id);
            if($comment==Null) abort(404);
            $title="مشاهده نظر ";
            $backward_url=Route('adminVillaCommentList');
        }else{
            abort(404);
        }


        $data=[
            'request_type'=>'edit',
            'comment'=>$comment,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('doEditVillaComment'),
            'edit_id'=>$comment->id,
        ];

        return view('admin.pages.forms.add_villaComment' ,$data);

    }



    public function doEditComment(Request $request){

        $validator = Validator::make($request->all(),[
            'comment_text'=>'required|max:280',
            'comment_status'=>'required|integer',
            'edit_id'=>'required|integer|exists:user_villa_comments,id',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if($this->changeUserVillaComment($request)){
            $msg=['نظر مورد نظر با موفقیت بروزرسانی شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminVillaCommentList')))->with('messages', $msg);

    }


    private function changeUserVillaComment($request){
        if($request->edit_id!=Null) {
            $comment=UserVillaComments::find($request->edit_id);
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
            UserVillaComments::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminVillaCommentList')))->with('messages', $msg);
    }















}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function cities(Request $request){

        if($request->parent_id!=Null){
            $parent_city=\App\Models\City::find($request->parent_id);
            $parent_city_level2=\App\Models\City::find($parent_city->parent_id);
            if($parent_city_level2==Null){
                $title="لیست شهرهای استان ". $parent_city->city_name;
                $backward_url=Route('cities-list').'/'.$parent_city->id;
                $add_url=Route('add-city-form',$parent_city->id);
                $canHasSubCity=true;
            }else{
                $title="لیست مناطق شهر ". $parent_city->city_name." - استان ".$parent_city_level2->city_name;
                $backward_url=Route('cities-list');
                $add_url=Route('add-city-form',$parent_city->id);
                $canHasSubCity=false;
            }

        }else{
            $title="لیست استانها";
            $backward_url=Route('dashboard');
            $add_url=Route('add-city-form');
            $canHasSubCity=true;
        }

        $cities=\App\Models\City::select('*')->where('parent_id','=',$request->parent_id)->orderBy('created_at')->get();

        $del_url=Route('do-delete-city',$request->parent_id);

        $resp=[
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url,
            'cities'=>$cities,
            'parent_id'=>$request->parent_id,
            'canHasSubCity'=>$canHasSubCity
        ];


        return view('admin.pages.lists.cities' ,$resp);
    }

    public function showAddCityForm(Request $request){

        if($request->parent_id!=Null){
            $parent_city=\App\Models\City::find($request->parent_id);
            $parent_city_level2=\App\Models\City::find($parent_city->parent_id);
            if($parent_city_level2==Null){
                $title="افزودن شهر جدید به استان ". $parent_city->city_name;
            }else{
                $title="افزودن منطقه جدید به شهر ". $parent_city->city_name." - استان ".$parent_city_level2->city_name;
            }

        }else{
            $title="افزودن استان جدید به سیستم";
        }
        $backward_url=Route('cities-list',$request->parent_id);

        $resp=[
            'title'=>$title,
            'post_add_url'=>Route('do-add-city'),
            'request_type'=>'add',
            'parent_id'=>$request->parent_id,
            'backward_url'=>$backward_url,
        ];
        return view('admin.pages.forms.add_city' ,$resp);
    }


    public function saveCity(Request $request){

        $this->validate($request, [
            'city_name' => 'required|min:2|max:255|unique:cities',
            'city_description'=>'min:2|max:1000',
            'city_order'=>'required|integer',
            'city_status'=>'required|integer',
            'parent_id' => 'nullable|exists:cities,id',
        ]);







        $city = new \App\Models\City;
        $city->city_name=$request->city_name;
        $city->city_description=nl2br($request->city_description);
        $city->parent_id=$request->parent_id;
        $city->city_order=$request->city_order;
        $city->city_status=$request->city_status;
        $city->save();

        $msg=['مورد جدید با موفقیت اضافه شد'];

        return redirect(url(Route('cities-list',$request->parent_id)))->with('messages', $msg);


    }











    public function editCity(Request $request){



        $city=\App\Models\City::where('id','=',$request->id)->first();
        if($city==Null){
            die('invalid request!');
        }

        $parent=$city->province()->first();
        if($parent==Null){
            $parent_id=Null;
            $title="ویرایش  ".$city->city_name;
        }else{

            $parent_city_level2=$parent->province()->first();
            if($parent_city_level2==Null){
                $title="ویرایش  ".$city->city_name." به استان  متعلق". $parent->city_name;
            }else{
                $title="ویرایش ". $city->city_name." متعلق به شهر ". $parent->city_name." - استان ".$parent_city_level2->city_name;
            }
            $parent_id=$parent->id;
        }



        $backward_url=Route('cities-list',$request->parent_id);


        $resp=[
            'city'=>$city,
            'request_type'=>'edit',
            'post_edit_url'=>Route('do-edit-city'),
            'parent_id'=>$parent_id,
            'edit_id'=>$city->id,
            'title'=>$title,
            'backward_url'=>$backward_url,
        ];





        return view('admin.pages.forms.add_city' ,$resp);
    }


    public function doEditCity(Request $request){


        $this->validate($request, [
            'city_name' => 'required|min:2|max:255|unique:cities,city_name,'.$request->edit_id,
            'city_description'=>'min:2|max:1000',
            'city_order'=>'required|integer',
            'city_status'=>'required|integer',
            'edit_id' => 'required|exists:cities,id',
        ]);



        $city=\App\Models\City::find($request->edit_id);

        $city->city_name=$request->city_name;
        $city->city_description=nl2br($request->city_description);
        $city->city_order=$request->city_order;
        $city->city_status=$request->city_status;
        $city->save();

        $msg=[
            $city->city_name.' با موفقیت ویرایش شد'
        ];
        return redirect(url(Route('cities-list',$city->parent_id)))->with('messages', $msg);

    }




    public function deleteCity(Request $request){

        if(isset($request->remove_val)){
            \App\Models\City::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('cities-list',$request->parent_id)))->with('messages', $msg);


    }










}

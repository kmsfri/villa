<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function properties(Request $request){
        if($request->parent_id==Null){
            $title="لیست خصوصیات موجود در وب سایت";
        }else{
            $prop_val=\App\Models\Property::find($request->parent_id);
            if($prop_val==Null){die('invalid request');}
            $title="مقادیر تعریف شده برای خصوصیت: ".$prop_val->prop_title;
        }
        $properties=\App\Models\Property::select('*')
            ->where('parent_id','=',$request->parent_id)
            ->orderBy('prop_order')
            ->orderBy('created_at')->get();

        $resp=[
            'title'=>$title,
            'add_url'=>Route('addPropertyForm',$request->parent_id),
            'del_url'=>Route('deleteProperty',$request->parent_id),
            'properties'=>$properties,
            'parent_id'=>$request->parent_id,

        ];

        return view('admin.pages.lists.properties' ,$resp);
    }

    public function showAddPropertyForm(Request $request){
        if($request->parent_id!=Null){
            $parent_prop=\App\Models\Property::find($request->parent_id);
            $title="افزودن مقدار جدید به خصوصیت ". $parent_prop->prop_title;
        }else{
            $title="افزودن خصوصیت جدید به سیستم";
        }

        $resp=[
            'post_add_url'=>Route('saveProperty'),
            'request_type'=>'add',
            'parent_id'=>$request->parent_id,
            'title'=>$title,
        ];

        return view('admin.pages.forms.add_property' ,$resp);
    }

    public function saveProperty(Request $request){

        $this->validate($request, [
            'prop_title' => 'required|min:1|max:20|unique:properties,prop_title',
            'has_text_value'=>'nullable|integer',
            'prop_order'=>'required|integer',
            'prop_status'=>'required|integer',
            'guide_text'=>'nullable|max:140',
            'parent_id' => 'nullable|exists:properties,id',
        ]);


        if(isset($request->parent_id) && $request->parent_id!=Null){
            $parent_property=\App\Models\Property::findOrFail($request->parent_id);
            if($parent_property->has_text_value==1) die('invalid request!');
        }

        $prop = new \App\Models\Property;
        $prop->parent_id=$request->parent_id;
        $prop->prop_title=$request->prop_title;
        if(isset($request->parent_id) && $request->parent_id!=Null){
            $prop->has_text_value=0;
            $prop->guide_text=Null;
        }else{
            $prop->has_text_value=$request->has_text_value;
            $prop->guide_text=$request->guide_text;
        }
        $prop->prop_status=$request->prop_status;
        $prop->prop_order=$request->prop_order;
        $prop->save();


        if($request->parent_id==Null){
            $msg=['خصوصیت جدید با موفقیت به سیستم اضافه شد'];
        }else{
            $msg=['مقدار جدید با موفقیت اضافه شد'];
        }

        return redirect(url(Route('propertiesList',$request->parent_id)))->with('messages', $msg);

    }


    public function deleteProperty(Request $request){
        if(isset($request->remove_val)){
            \App\Models\Property::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];
        return redirect(url(Route('propertiesList',$request->parent_id)))->with('messages', $msg);
    }



    public function editProperty(Request $request){
        $prop=\App\Models\Property::where('id','=',$request->id)->first();
        if($prop==Null){
            die('invalid request!');
        }

        $parent=$prop->Property()->first();
        if($parent==Null){
            $parent_id=Null;
            $title="ویرایش خصوصیت ".$prop->prop_title;
        }else{
            $parent_id=$parent->id;
            $title="ویرایش مقدار ".$prop->prop_title." متعلق به خصوصیت ".$parent->prop_title;
        }


        $resp=[
            'post_edit_url'=>Route('doEditProperty'),
            'property'=>$prop,
            'request_type'=>'edit',
            'parent_id'=>$parent_id,
            'title'=>$title,
            'edit_id'=>$prop->id,
        ];

        return view('admin.pages.forms.add_property' ,$resp);
    }


    public function doEditProperty(Request $request){

        $this->validate($request, [
            'edit_id' => 'required|exists:properties,id',
            'prop_title' => 'required|min:1|max:20|unique:properties,prop_title,'.$request->edit_id,
            'has_text_value'=>'nullable|integer',
            'guide_text'=>'nullable|max:140',
            'prop_order'=>'required|integer',
            'prop_status'=>'required|integer',
        ]);


        $prop=\App\Models\Property::find($request->edit_id);

        if($prop->parent_id!=Null){
            $parent_property=\App\Models\Property::findOrFail($prop->parent_id);
            if($parent_property->has_text_value==1) die('invalid request!');
        }else{
            if($request->has_text_value==1 && $prop->PropValue()->count()>0){
                $msg=["خصوصیات متنی نمیتوانند مقدار ثابت داشته باشند. برای تغییر یک خصوصیت به خصوصیت متنی لطفا ابتدا مقادیر آن را حذف نمایید."];
                return back()
                    ->withInput()
                    ->with(['messages'=>$msg]);
            }
        }

        $prop->prop_title=$request->prop_title;
        if($prop->parent_id!=Null){
            $prop->has_text_value=0;
            $prop->guide_text=Null;
        }else{
            $prop->has_text_value=$request->has_text_value;
            $prop->guide_text=$request->guide_text;
        }
        $prop->prop_status=$request->prop_status;
        $prop->prop_order=$request->prop_order;
        $prop->save();

        $msg=[
            $prop->prop_title.' با موفقیت ویرایش شد'
        ];
        return redirect(url(Route('propertiesList',$prop->parent_id)))->with('messages', $msg);

    }
}

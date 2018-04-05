<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PropertyController extends Controller
{
    public function properties(Request $request){
        if($request->parent_id==Null){
            $title="لیست خصوصیات موجود در وب سایت";
            $canHasSubProp=true;
        }else{
            $prop_val=\App\Models\Property::find($request->parent_id);
            $parent_prop2=\App\Models\Property::find($prop_val->parent_id);

            if($prop_val==Null){die('invalid request');}
            $title="مقادیر تعریف شده برای خصوصیت: ".$prop_val->prop_title;
            if($parent_prop2==Null){
                $canHasSubProp=true;
            }else{
                $canHasSubProp=false;
            }



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
            'canHasSubProp'=>$canHasSubProp,

        ];

        return view('admin.pages.lists.properties' ,$resp);
    }

    public function showAddPropertyForm(Request $request){
        if($request->parent_id!=Null){
            $parent_prop=\App\Models\Property::find($request->parent_id);
            $title="افزودن مقدار جدید به خصوصیت ". $parent_prop->prop_title;
            if($parent_prop==Null){die('invalid request');}

            $parent_prop2=\App\Models\Property::find($parent_prop->parent_id);

            if($parent_prop2==Null){
                $canHasSubProp=true;
            }else{
                $canHasSubProp=false;
            }



        }else{
            $title="افزودن خصوصیت جدید به سیستم";
            $canHasSubProp=true;
        }

        $resp=[
            'post_add_url'=>Route('saveProperty'),
            'request_type'=>'add',
            'parent_id'=>$request->parent_id,
            'title'=>$title,
            'canHasSubProp'=>$canHasSubProp,
        ];

        return view('admin.pages.forms.add_property' ,$resp);
    }

    public function saveProperty(Request $request){

        $this->validate($request, [
            'prop_title' => 'required|min:1|max:50|unique:properties,prop_title',
            'has_text_value'=>'nullable|integer',
            'multi_assign'=>'required|integer',
            'prop_order'=>'required|integer',
            'prop_status'=>'required|integer',
            'guide_text'=>'nullable|max:140',
            'parent_id' => 'nullable|exists:properties,id',
            'img_dir' => 'mimes:png,jpg,jpeg|max:1048',
        ]);


        if(isset($request->parent_id) && $request->parent_id!=Null){
            $parent_property=\App\Models\Property::findOrFail($request->parent_id);
            if($parent_property->has_text_value==1) die('invalid request!');
        }

        if($this->changeProperty($request)){
            if($request->parent_id==Null){
                $msg=['خصوصیت جدید با موفقیت به سیستم اضافه شد'];
            }else{
                $msg=['مقدار جدید با موفقیت اضافه شد'];
            }
        }else{
            validator_fails:
            $msg=["عملیات با مشکل مواجه شد!"];
            return back()
                ->withInput()
                ->with(['messages'=>$msg]);
        }

        return redirect(url(Route('propertiesList',$request->parent_id)))->with('messages', $msg);

    }


    private function changeProperty($request,$propObject=Null){
        $uploaded_file_dir="";
        $this->img_upload_error_msg=array();
        $to_remove_dir="";
        try {
            if($request->img_dir!=Null) {

                $file = $request->file('img_dir');
                $fileName = "";

                if ($file == null) {
                    $fileName = "";
                } else {

                    if ($file->isValid()) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $destinationPath = '/images/propertyImages/';

                        $file->move(public_path().$destinationPath, $fileName);
                        $uploaded_file_dir = $destinationPath.'/'.$fileName;
                        if($request->edit_id!=Null) {
                            $to_remove_dir = \App\Models\Property::find($request->edit_id)->img_dir;
                        }
                    } else {
                        $this->img_upload_error_msg = 'آپلود تصویر ناموفق بود';
                        goto catch_block;
                    }
                }

            }

            DB::transaction(function() use($request,$uploaded_file_dir,$to_remove_dir,$propObject){
                if($request->edit_id!=Null) {
                    $prop = Clone $propObject;
                }else{
                    $prop = new \App\Models\Property;
                    $prop->parent_id=$request->parent_id;
                }

                $prop->prop_title=$request->prop_title;
                $prop->has_text_value=$request->has_text_value;
                $prop->guide_text=$request->guide_text;
                if($uploaded_file_dir!="") {
                    $prop->img_dir = $uploaded_file_dir;
                }
                $prop->multi_assign=$request->multi_assign;
                $prop->prop_status=$request->prop_status;
                $prop->prop_order=$request->prop_order;
                $prop->save();


                if($request->edit_id!=Null && $to_remove_dir!=""){
                    if(file_exists(public_path().$to_remove_dir)){
                        unlink(public_path().$to_remove_dir);
                    }
                }
            });

        }
        catch(Exception $e) {
            catch_block:
            if(file_exists(public_path().$uploaded_file_dir)){
                unlink(public_path().$uploaded_file_dir);
            }
            return false;
        }
        return true;
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
            $canHasSubProp=true;
        }else{
            $parent_id=$parent->id;
            $title="ویرایش مقدار ".$prop->prop_title." متعلق به خصوصیت ".$parent->prop_title;

            if($parent->parent_id==Null){
                $canHasSubProp=true;
            }else{
                $canHasSubProp=false;
            }


        }


        $resp=[
            'post_edit_url'=>Route('doEditProperty'),
            'property'=>$prop,
            'request_type'=>'edit',
            'parent_id'=>$parent_id,
            'title'=>$title,
            'edit_id'=>$prop->id,
            'canHasSubProp'=>$canHasSubProp,
        ];

        return view('admin.pages.forms.add_property' ,$resp);
    }


    public function doEditProperty(Request $request){

        $this->validate($request, [
            'edit_id' => 'required|exists:properties,id',
            'prop_title' => 'required|min:1|max:50|unique:properties,prop_title,'.$request->edit_id,
            'has_text_value'=>'nullable|integer',
            'guide_text'=>'nullable|max:140',
            'multi_assign'=>'required|integer',
            'prop_order'=>'required|integer',
            'prop_status'=>'required|integer',
            'img_dir' => 'mimes:png,jpg,jpeg|max:1048',
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

        if($this->changeProperty($request,$prop)){
            $msg=[
                $prop->prop_title.' با موفقیت ویرایش شد'
            ];
        }else{
            validator_fails:
            $msg=["عملیات با مشکل مواجه شد!"];
            return back()
                ->withInput()
                ->with(['messages'=>$msg]);
        }


        return redirect(url(Route('propertiesList',$prop->parent_id)))->with('messages', $msg);

    }
}

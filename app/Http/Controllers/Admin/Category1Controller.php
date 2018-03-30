<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Category1Controller extends Controller
{
    public function categories(Request $request){

        if($request->parent_id!=Null){
            $parent_ctg=\App\Models\Category1::find($request->parent_id);
            $parent_ctg_level2=\App\Models\Category1::find($parent_ctg->parent_id);
            if($parent_ctg_level2==Null){
                $title="زیرمجموعه های دسته بندی: ". $parent_ctg->category_title;
                $backward_url=Route('categories1-list').'/'.$parent_ctg->id;
                $add_url=Route('add-category1-form',$parent_ctg->id);
                $canHasSubCategory=true;
            }else{
                $title="زیرمجموعه های دسته بندی: ". $parent_ctg->category_title;
                $backward_url=Route('categories1-list');
                $add_url=Route('add-category1-form',$parent_ctg->id);
                $canHasSubCategory=false;
            }

        }else{
            $title="لیست دسته بندیهای مطالب گردشگری";
            $backward_url=Route('dashboard');
            $add_url=Route('add-category1-form');
            $canHasSubCategory=true;
        }

        $categories=\App\Models\Category1::select('*')->where('parent_id','=',$request->parent_id)->orderBy('created_at')->get();

        $del_url=Route('do-delete-category1',$request->parent_id);

        $resp=[
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url,
            'categories'=>$categories,
            'parent_id'=>$request->parent_id,
            'canHasSubCategory'=>$canHasSubCategory,
            'ctgType'=>1,
        ];


        return view('admin.pages.lists.categories' ,$resp);
    }

    public function showAddCategoryForm(Request $request){

        if($request->parent_id!=Null){
            $parent_ctg=\App\Models\Category1::find($request->parent_id);
            $parent_ctg_level2=\App\Models\Category1::find($parent_ctg->parent_id);
            if($parent_ctg_level2==Null){
                $title="افزودن دسته بندی مطالب گردشگری جدید به: ". $parent_ctg->category_title;
            }else{
                $title="افزودن دسته بندی مطالب گردشگری جدید به: ". $parent_ctg->category_title." - متعلق به: ".$parent_ctg_level2->category_title;
            }

        }else{
            $title="افزودن دسته بندی مربوط به مطالب گردشگری";
        }
        $backward_url=Route('categories1-list',$request->parent_id);

        $resp=[
            'title'=>$title,
            'post_add_url'=>Route('do-add-category1'),
            'request_type'=>'add',
            'parent_id'=>$request->parent_id,
            'backward_url'=>$backward_url,
        ];
        return view('admin.pages.forms.add_category' ,$resp);
    }


    public function saveCategory(Request $request){

        $category_slug_corrected='';
        if(isset($request->category_slug) && $request->category_slug!=null){
            $category_slug_corrected=\Helpers::make_slug($request->category_slug);
        }

        $newRequest = new \Illuminate\Http\Request();
        $newRequest->replace([
            'category_title' => $request->category_title,
            'category_order'=>$request->category_order,
            'category_status'=>$request->category_status,
            'category_slug_corrected'=>$category_slug_corrected,
            'parent_id' => $request->parent_id,
        ]);

        $this->validate($newRequest, [
            'category_title' => 'required|min:2|max:255|unique:categories1',
            'category_order'=>'required|integer',
            'category_status'=>'required|integer',
            'category_slug_corrected'=>'required|unique:categories1,category_slug',
            'parent_id' => 'nullable|exists:categories1,id',
        ]);


        $ctg = new \App\Models\Category1();
        $ctg->category_title=$newRequest->category_title;
        $ctg->parent_id=$newRequest->parent_id;
        $ctg->category_order=$newRequest->category_order;
        $ctg->category_status=$newRequest->category_status;
        $ctg->category_slug=$newRequest->category_slug_corrected;
        $ctg->save();

        $msg=['دسته بندی جدید با موفقیت اضافه شد'];

        return redirect(url(Route('categories1-list',$request->parent_id)))->with('messages', $msg);


    }






    public function editCategory(Request $request){



        $ctg=\App\Models\Category1::where('id','=',$request->id)->first();
        if($ctg==Null){
            die('invalid request!');
        }

        $parent=$ctg->ParentCategory1()->first();
        if($parent==Null){
            $parent_id=Null;
            $title="ویرایش  ".$ctg->category_title;
        }else{

            $parent_ctg_level2=$parent->ParentCategory1()->first();
            if($parent_ctg_level2==Null){
                $title="ویرایش  ".$ctg->category_title." متعلق به: ". $parent->category_title;
            }else{
                $title="ویرایش  ".$ctg->category_title." متعلق به: ". $parent->category_title." - ".$parent_ctg_level2->category_title;
            }
            $parent_id=$parent->id;
        }

        $backward_url=Route('categories1-list',$request->parent_id);


        $resp=[
            'category'=>$ctg,
            'request_type'=>'edit',
            'post_edit_url'=>Route('do-edit-category1'),
            'parent_id'=>$parent_id,
            'edit_id'=>$ctg->id,
            'title'=>$title,
            'backward_url'=>$backward_url,
        ];


        return view('admin.pages.forms.add_category' ,$resp);
    }


    public function doEditCategory(Request $request){

        if(isset($request->category_slug) && $request->category_slug!=null){
            $category_slug_corrected=\Helpers::make_slug($request->category_slug);
        }

        $newRequest = new \Illuminate\Http\Request();
        $newRequest->replace([
            'category_title' => $request->category_title,
            'category_order'=>$request->category_order,
            'category_status'=>$request->category_status,
            'category_slug_corrected'=>$category_slug_corrected,
            'edit_id' => $request->edit_id,
        ]);


        $this->validate($newRequest, [
            'category_title' => 'required|min:2|max:255|unique:categories1,category_title,'.$newRequest->edit_id,
            'category_order'=>'required|integer',
            'category_status'=>'required|integer',
            'category_slug_corrected'=>'required|unique:categories1,category_slug,'.$newRequest->edit_id,
            'edit_id' => 'required|exists:categories1,id',
        ]);



        $ctg=\App\Models\Category1::find($newRequest->edit_id);
        $ctg->category_title=$newRequest->category_title;
        $ctg->category_order=$newRequest->category_order;
        $ctg->category_status=$newRequest->category_status;
        $ctg->category_slug=$newRequest->category_slug_corrected;
        $ctg->save();

        $msg=[
            $ctg->category_title.' با موفقیت ویرایش شد'
        ];
        return redirect(url(Route('categories1-list',$ctg->parent_id)))->with('messages', $msg);

    }




    public function deleteCategory(Request $request){

        if(isset($request->remove_val)){
            \App\Models\Category1::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('categories1-list',$request->parent_id)))->with('messages', $msg);


    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Villa;
use \App\Models\UserVillaReports;
use Validator;

class ReportController extends Controller
{
    public function Reports(Request $request){

        if(isset($request->villa_id) && $request->villa_id!=Null){
            $villa=Villa::find($request->villa_id);
            if($villa==Null) abort(404);

            $reports=UserVillaReports::where('villa_id',$villa->id)
                                        ->orderBy('created_at','DESC')
                                        ->orderBy('updated_at','DESC')
                                        ->get();

            $title="گزارشات تخلف ویلای: ".$villa->villa_title;

        }else{
            $reports=UserVillaReports::orderBy('created_at','DESC')
                    ->orderBy('updated_at','DESC')
                    ->get();
            $title="گزارشات تخلف ویلاها";
        }

        $backward_url=Route('dashboard');
        $add_url=Null;
        $del_url=Route('doDeleteReport');

        $resp=[
            'reports'=>$reports,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];



        return view('admin.pages.lists.villaReports' ,$resp);
    }


    public function editReport(Request $request){
        if($request->id!=Null){
            $report=UserVillaReports::find($request->id);
            if($report==Null) abort(404);
            $title="مشاهده گزارش تخلف ";
            $backward_url=Route('adminReportList');
        }else{
            abort(404);
        }


        $data=[
            'request_type'=>'edit',
            'report'=>$report,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('doEditReport'),
            'edit_id'=>$report->id,
        ];

        return view('admin.pages.forms.add_villaReport' ,$data);

    }



    public function doEditReport(Request $request){

        $validator = Validator::make($request->all(),[
            'report_text'=>'required|max:280',
            'report_status'=>'required|integer',
            'edit_id'=>'required|integer|exists:user_villa_reports,id',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if($this->changeUserVillaReport($request)){
            $msg=['گزارش تخلف مورد نظر با موفقیت ویرایش شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminReportList')))->with('messages', $msg);

    }


    private function changeUserVillaReport($request){
        if($request->edit_id!=Null) {
            $report=UserVillaReports::find($request->edit_id);
            if($report==Null) abort(404);
        }else{
            abort(404);
        }



        $report->report_text=nl2br($request->report_text);
        $report->report_status=$request->report_status;
        $report->save();

        return True;

    }



    public function deleteReport(Request $request){

        if(isset($request->remove_val)){
            UserVillaReports::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminReportList')))->with('messages', $msg);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Tariff;
use Validator;
class TariffController extends Controller
{

    public function Tariffs(Request $request){

        $tariffs=Tariff::select('*')
            ->orderBy('tariff_status','DESC')
            ->orderBy('created_at')->get();

        $title="لیست تعرفه آگهی های ویژه";
        $backward_url=Route('dashboard');
        $add_url=Route('doAddTariff');
        $del_url=Route('doDeleteTariff');

        $resp=[
            'tariffs'=>$tariffs,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'add_url'=>$add_url,
            'del_url'=>$del_url
        ];

        return view('admin.pages.lists.tariffs' ,$resp);
    }


    public function showAddTariffForm(Request $request){

        $title="افزودن تعرفه جدید";
        $backward_url=Route('adminTariffList');

        $data=[
            'request_type'=>'add',
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_add_url'=>Route('doAddTariff'),

        ];
        return view('admin.pages.forms.add_tariff' ,$data);
    }


    public function saveTariff(Request $request){

        $validator = Validator::make($request->all(),[
            'tariff_title'=>'required|max:50',
            'tariff_duration'=>'required|integer',
            'tariff_price'=>'required|numeric|max:2000000',
            'tariff_needed_points'=>'required|numeric|max:2000000',
            'tariff_status'=>'required|integer',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if($this->changeTariff($request)){
            $msg=['تعرفه جدید با موفقیت افزوده شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminTariffList')))->with('messages', $msg);

    }




    public function editTariff(Request $request){
        if($request->id!=Null){
            $tariff=Tariff::find($request->id);
            if($tariff==Null) abort(404);
            $title="ویرایش تعرفه ";
            $backward_url=Route('adminTariffList');
        }else{
            abort(404);
        }

        $data=[
            'request_type'=>'edit',
            'tariff'=>$tariff,
            'title'=>$title,
            'backward_url'=>$backward_url,
            'post_edit_url'=>Route('doEditTariff'),
            'edit_id'=>$tariff->id,
        ];

        return view('admin.pages.forms.add_tariff' ,$data);

    }



    public function doEditTariff(Request $request){

        $validator = Validator::make($request->all(),[
            'tariff_title'=>'required|max:50',
            'tariff_duration'=>'required|integer',
            'tariff_price'=>'required|numeric|max:2000000',
            'tariff_needed_points'=>'required|numeric|max:2000000',
            'tariff_status'=>'required|integer',
            'edit_id'=>'required|integer|exists:tariffs,id',
        ]);


        if ($validator->fails()) {
            validator_fails:
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        if($this->changeTariff($request)){
            $msg=['تعرفه مورد نظر با موفقیت ویرایش شد'];
        }else{
            goto validator_fails;
        }

        return redirect(url(Route('adminTariffList')))->with('messages', $msg);

    }


    private function changeTariff($request){
        if($request->edit_id!=Null) {
            $tariff=Tariff::find($request->edit_id);
        }else{
            $tariff=new Tariff();
        }

        $tariff->tariff_title=$request->tariff_title;
        $tariff->tariff_duration=$request->tariff_duration;
        $tariff->tariff_price=$request->tariff_price;
        $tariff->tariff_needed_points=$request->tariff_needed_points;
        $tariff->tariff_status=$request->tariff_status;
        $tariff->save();

        return True;

    }



    public function deleteTariff(Request $request){

        if(isset($request->remove_val)){
            Tariff::destroy($request->remove_val);
        }
        $msg=['موارد انتخاب شده با موفقیت حذف شدند'];

        return redirect(url(Route('adminTariffList')))->with('messages', $msg);
    }
}

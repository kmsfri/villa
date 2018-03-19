<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxServicesController extends Controller
{
    public function get_province_cities(Request $request){

        $this->validate($request, [
            'r_id' => 'required|exists:cities,id',
        ]);

        $cities=\App\Models\City::select('id','parent_id','city_name')
            ->where('parent_id','=',$request->r_id)
            ->where('city_status','=',1)
            ->orderBy('city_order' , 'ASC')
            ->orderBy('created_at')->get();

        foreach ($cities as $key=>$ct){
            $cities[$key]->title=$ct->city_name;
        }
        return response()->json($cities);
    }
}

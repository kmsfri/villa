<?php

namespace App\Http\Middleware;

use Closure;

class UserPanelInitCommonData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $villa_types=\App\Models\VillaType::orderBy('villa_type_order','ASC')->get();


        $data=[
            'villa_types'=>$villa_types,
        ];


        \View::share( $data);

        return $next($request);
    }
}

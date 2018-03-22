<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response; //for return permission_denied.blade view in middleware
class CheckAdminPermission
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
        $user_id=Auth::guard('admin')->user()->id;
        $user=\App\Models\AdminUser::where('id','=',$user_id)->first();
        $admin_route_uri=\App\Models\AdminRoutesUri::where('route_uri','=',$request->route()->uri())
            ->where('route_type','=',$request->method())->first();

        if($admin_route_uri==null || $user->CheckRouteID($admin_route_uri->getParent()->first()->id)==0){


            $data=[
                'title'=>'اخطار',
                'err_msg'=>"کاربر گرامی، شما اجازه ی دسترسی به این بخش را ندارید.",
                'add_url'=>Null,
                'del_url'=>Null,
            ];
            return new Response(view('admin.pages.permission_denied',$data));
        }

        return $next($request);
    }
}

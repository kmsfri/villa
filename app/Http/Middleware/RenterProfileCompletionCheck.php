<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Response;
class RenterProfileCompletionCheck
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

        $user=Auth::guard('user')->user();
        if($user->fullname==Null || trim($user->fullname)=='' || $user->profile_slug==Null || trim($user->profile_slug)==''){
            $data=[
                'title'=>'اخطار', //Config--
                'err_msg'=>"کاربر گرامی، تا زمانی که اطلاعات پروفایل خود را تکمیل نکرده اید، نمیتوانید به این بخش دسترسی داشته باشید.", //Config--
                'user'=>$user,
            ];
            return new Response(view('user.panel.permission_denied',$data));
        }

        return $next($request);
    }
}

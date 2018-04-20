<?php

namespace App\Http\Middleware;

use App\Models\FooterLink;
use Closure;

class WebInitCommonData
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

        $footerLinks=\App\Models\FooterLink::where('parent_id',Null)
            ->where('link_status',1)
            ->orderBy('link_order')
            ->with('SubLinkEnabledOrdered')
            ->get();

        $menuLinks=\App\Models\MenuLink::where('parent_id',Null)
            ->where('link_status',1)
            ->orderBy('link_order')
            ->with('SubLinkEnabledOrdered')
            ->get();


        $socialMedia=\App\Models\Social::where('s_status',1)
            ->orderBy('s_order')
            ->get();


        $data=[
            'footerLinks'=>$footerLinks,
            'menuLinks'=>$menuLinks,
            'socialMedia'=>$socialMedia,
        ];


        \View::share( $data);
        return $next($request);
    }
}

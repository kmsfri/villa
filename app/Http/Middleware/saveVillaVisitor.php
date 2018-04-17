<?php

namespace App\Http\Middleware;

use Closure;

class saveVillaVisitor
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

        $villa = \App\Models\Villa::where('villa_slug','=',$request->slug)->where('villa_status',1)->first();
        if(!isset($villa)) abort(404);

        $last_visits_count=\App\Models\VillaVisit::where('ip','=',$request->ip())
            ->where('villa_id',$villa->id)
            ->whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 30 MINUTE)')
            ->count();

        if($last_visits_count==0){
            $visit=new \App\Models\VillaVisit;
            $visit->ip=$request->ip();
            $visit->villa_id=$villa->id;
            $visit->created_at=\Carbon\Carbon::now()->toDateTimeString();
            $visit->save();
        }

        $request->villa=$villa;

        return $next($request);
    }
}

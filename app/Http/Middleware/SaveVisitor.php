<?php

namespace App\Http\Middleware;

use Closure;

class SaveVisitor
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
        $last_visits_count=\App\Models\Visit::where('ip','=',$request->ip())
            ->whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 20 MINUTE)')
            ->count();




        if($last_visits_count==0){
            $visit=new \App\Models\Visit;
            $visit->ip=$request->ip();
            $visit->url=$request->path();
            $visit->created_at=\Carbon\Carbon::now()->toDateTimeString();
            $visit->save();
        }

        return $next($request);
    }
}

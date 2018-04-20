<?php

namespace App\Http\Middleware;

use Closure;
use \App\Models\Content;
class saveContentVisitor
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

        $content = Content::where('content_slug','=',$request->slug)->where('content_status',1)->where('is_draft',0)->first();
        if(!isset($content)) abort(404);


        $last_visits_count=\App\Models\ContentVisit::where('ip','=',$request->ip())
            ->where('content_id',$content->id)
            ->whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 30 MINUTE)')
            ->count();

        if($last_visits_count==0){
            $visit=new \App\Models\ContentVisit;
            $visit->ip=$request->ip();
            $visit->content_id=$content->id;
            $visit->created_at=\Carbon\Carbon::now()->toDateTimeString();
            $visit->save();
        }

        $request->contentData=$content;

        return $next($request);
    }
}

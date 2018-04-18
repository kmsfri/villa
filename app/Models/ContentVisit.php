<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentVisit extends Model
{
    protected $table = 'content_visits';
    protected $primaryKey = 'id';


    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }


    public static function today_visits(){
        return ContentVisit::whereRaw('DATE(created_at) =CURDATE()');
    }
    public static function last24_visits(){
        return ContentVisit::whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 24 HOUR)');
    }
    public static function lastWeek_visits(){
        return ContentVisit::whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 7 DAY)');
    }
    public static function lastMonth_visits(){
        return ContentVisit::whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 1 MONTH)');
    }
    public function all_visits(){
        return $this;
    }
}

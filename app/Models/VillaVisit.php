<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaVisit extends Model
{
    protected $table = 'villa_visits';
    protected $primaryKey = 'id';


    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }


    public function today_visits(){
        return $this->whereRaw('DATE(created_at) =CURDATE()');
    }
    public function last24_visits(){
        return $this->whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 24 HOUR)');
    }
    public function lastWeek_visits(){
        return $this->whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 7 DAY)');
    }
    public function lastMonth_visits(){
        return $this->whereRaw('created_at >= ("'.\Carbon\Carbon::now()->toDateTimeString().'" -INTERVAL 1 MONTH)');
    }
    public function all_visits(){
        return $this;
    }
}

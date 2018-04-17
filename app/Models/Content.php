<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    protected $primaryKey = 'id';

    public function authorAdminUser()
    {
        return $this->belongsTo('App\Models\AdminUser','admin_user_id');
    }

    public function authorRenterUser()
    {
        return $this->belongsTo('App\Models\RenterUser','renter_user_id');
    }

    public function ContentImages()
    {
        return $this->hasMany('App\Models\ContentImage');
    }
    public function Reports()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_villa_reports','content_id','renter_user_id');
    }
    public function Categories3()
    {
        return $this->belongsToMany('App\Models\Category3','content_category3','content_id','category_id');
    }

    public function RenterUserScores()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_content_scores','content_id','renter_user_id')->withTimestamps();
    }

    public function RenterUserComments()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_content_comments','content_id','renter_user_id')->withTimestamps();
    }
    public function Cities()
    {
        return $this->belongsToMany('App\Models\City','content_city','content_id','city_id');
    }
    public static function related_contents($city_id){

        return $contents = Content::whereHas('Cities', function ($q) use ($city_id) {
            $q->whereIn('city_id', $city_id);
        })->where('content_status',0)->where('is_draft',0)->take(6)->get();
    }

}

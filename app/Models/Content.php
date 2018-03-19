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

    public function Categories3()
    {
        return $this->belongsToMany('App\Models\Category3');
    }

    public function RenterUserScores()
    {
        return $this->belongsToMany('App\Models\RenterUser');
    }

    public function RenterUserComments()
    {
        return $this->belongsToMany('App\Models\RenterUser');
    }
    public function Cities()
    {
        return $this->belongsToMany('App\Models\City','content_city','content_id','city_id');
    }

}

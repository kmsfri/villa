<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenterUser extends Model
{
    protected $table = 'renter_users';
    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
    ];

    public function Tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function GivenScores()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_renter_user_scores','promoter_user_id','renter_user_id');
    }

    public function GainedScores()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_renter_user_scores','renter_user_id','promoter_user_id');
    }

    public function ContentGivenScores()
    {
        return $this->belongsToMany('App\Models\Content','user_content_scores','renter_user_id','content_id');
    }

    public function ContentSavedComments()
    {
        return $this->belongsToMany('App\Models\Content','user_content_comments','renter_user_id','content_id');
    }

    public function VillaSavedReports()
    {
        return $this->belongsToMany('App\Models\Villa','user_villa_reports','renter_user_id','villa_id');
    }

    public function VillaSavedComments()
    {
        return $this->belongsToMany('App\Models\Villa','user_villa_comments','renter_user_id','villa_id');
    }

    public function SavedWebsiteComment()
    {
        return $this->hasMany('App\Models\WebsiteComment');
    }

    public function Villas()
    {
        return $this->hasMany('App\Models\Villa');
    }

    public function SpecialVillas() //has a Paid Tariff(n to n Database Relation)
    {
        return $this->belongsToMany('App\Models\Villa','renter_user_villa_tairff','renter_user_id','villa_id');
    }

    public function BoutghtTariffs()
    {
        return $this->belongsToMany('App\Models\Tariffs','renter_user_villa_tairff','renter_user_id','tariff_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $table = 'villa';
    protected $primaryKey = 'id';

    public function RenterUser()
    {
        return $this->belongsTo('App\Models\RenterUser');
    }

    public function SpecialRenterUser() //has a Paid Tariff(n to n Database Relation)
    {
        return $this->belongsToMany('App\Models\RenterUser','renter_user_villa_tariff','villa_id','renter_user_id');
    }

    public function BoutghtTariffs()
    {
        return $this->belongsToMany('App\Models\Tariff','renter_user_villa_tariff','villa_id','tariff_id');
    }

    public function Reports()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_villa_reports','villa_id','renter_user_id');
    }

    public function Comments()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_villa_comments','villa_id','renter_user_id')->withTimestamps();
    }


    public function Properties()
    {
        return $this->belongsToMany('App\Models\Property','villa_property_value','villa_id','property_id')->withPivot('description_text','text_value');
    }


    public function SpecProperty($prop_id)
    {
        return $this->belongsToMany('App\Models\Property','villa_property_value', 'villa_id','property_id')
            ->where('parent_id','=',$prop_id)->first();
    }

    public function AllSpecProperty($prop_id)
    {
        return $this->belongsToMany('App\Models\Property','villa_property_value', 'villa_id','property_id')
            ->where('parent_id','=',$prop_id)->get();
    }


    public function Categories1()
    {
        return $this->belongsToMany('App\Models\Category1','villa_category1','villa_id','category_id');
    }

    public function Categories2()
    {
        return $this->belongsToMany('App\Models\Category2');
    }


    public function ReserveRequests()
    {
        return $this->hasMany('App\Models\VillaReserveRequest');
    }

    public function VillaImages()
    {
        return $this->hasMany('App\Models\VillaImage');
    }


    public function Cities()
    {
        return $this->belongsToMany('App\Models\City','villa_city','villa_id','city_id');
    }
    public function RenterUserScores()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_villa_scores','villa_id','renter_user_id')->withPivot('score_type','score_value')->withTimestamps();
    }


    public static function related_villas($city_id,$villa_id){

        return $villas = Villa::whereHas('Cities', function ($q) use ($city_id) {
            $q->whereIn('city_id', $city_id);
        })->where('villa_status',1)->where('id','!=',$villa_id)->take(6)->get();
    }


    public function VillaType()
    {
        return $this->belongsTo('App\Models\VillaType');
    }

    public function GrantedPoints()
    {
        return $this->belongsToMany('App\Models\RenterUser','user_granted_points','villa_id','renter_user_id');
    }


}

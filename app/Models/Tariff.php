<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $table = 'tariffs';
    protected $primaryKey = 'id';

    public function BuyerRenterUsers()
    {
        return $this->belongsToMany('App\Models\RenterUser','renter_user_villa_tairff','tariff_id','renter_user_id');
    }

    public function Villas()
    {
        return $this->belongsToMany('App\Models\Villa','renter_user_villa_tairff','tariff_id','villa_id');
    }
}

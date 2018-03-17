<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';

    public function PropValue()
    {
        return $this->hasMany('App\Models\Property','parent_id');
    }

    public function PropEnabledValues()
    {
        return $this->hasMany('App\Models\Property','parent_id')
            ->where('prop_status','=',1)
            ->orderBy('prop_order','ASC');
    }

    public function Property()
    {
        return $this->belongsTo('App\Models\Property','parent_id');
    }

    public function Villas()
    {
        return $this->belongsToMany('App\Models\Villa','villa_property_value','property_id','villa_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';


    public function city()
    {
        return $this->hasMany('App\Models\City');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\City','parent_id');
    }
    public function Contents()
    {
        return $this->belongsToMany('App\Models\Content');
    }
    public function Villas()
    {
        return $this->belongsToMany('App\Models\Villa');
    }
}
